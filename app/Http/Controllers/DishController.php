<?php

namespace App\Http\Controllers;

use App\Category;
use App\Dish;
use App\DishAdd;
use App\DishInfo;
use App\DishPrice;
use App\OrderDetails;
use App\Product;
use App\ProductType;
use App\Recipe;
use App\Voiddish;
use Carbon\Carbon;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;
use App\DishTranslation;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use \Hyn\Tenancy\Website\Directory;

class DishController extends Controller
{
    /**
     * It will show an form of add dish
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addDish()
    {

        return view('user.admin.dish.add-dish');
    }

    /**
     * User can see all available dish in the restaurant by this method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allDish()
    {


        $dishes = Dish::all();
        return view('user.admin.dish.all-dish', [
            'dishes' => $dishes
        ]);
    }

    /**
     * User can able to edit selected dish by this method
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editDish($id)
    {
        $dish = Dish::findOrFail($id);
        return view('user.admin.dish.edit-dish', [
            'dish' => $dish
        ]);
    }

    /**
     * User can able to view the dish with price and images by this method
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDish($id)
    {
        $dish = Dish::findOrFail($id);
        return view('user.admin.dish.view-dish', [
            'dish' => $dish
        ]);
    }

    /**
     * User can delete dish (only if there is order on this dish) by this method
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteDish($id)
    {
        $dish = Dish::findOrFail($id);
        $dish_on_order = OrderDetails::where('dish_id', $id)->first();
        if (!$dish_on_order) {
            DishPrice::where('dish_id', $dish->id)->delete();
            DishInfo::where('dish_id', $dish->id)->delete();
            $dish->delete();
            return redirect()->back()->with('delete_success', 'Dish has been delete successfully ..');
        } else {
            return redirect()
                ->back()
                ->with('delete_error',
                    'Dish cannot delete ! This dish has been used in order. If you dont want to show this dish anymore you can simply de-active this dish');
        }
    }

    /**
     * User can able to add new dish by this method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveDish(Request $request)
    {
        // dd($request->input());
        $dish = new Dish();
        $dish->dish = ''; // $request->get('dish');
        $dish->description = ''; //$request->get('description');
        $dish->category_id = $request->get('category_id');
        if ($request->hasFile('thumbnail')) {
            // dd($request->file('thumbnail'));
            $img = $request->file('thumbnail');
            $filename = date("dmY-his") . $img->getClientOriginalName();

            $fulllink = 'media/images/library';

            Storage::disk('tenant')->put($fulllink . '/' . $filename, file_get_contents($img), 'public');
            $dish->thumbnail = $fulllink . '/' . $filename;
            /*$request->file('thumbnail')
                ->move('uploads/dish/thumbnail',
                    rand(8000000, 99999999) . '.' . $request->thumbnail->extension());*/
        }
        $dish->user_id = auth()->user()->id;

        $dish->fill([
            'en' => $request->input('en'),
            'ar' => $request->input('ar'),
            'hi' => $request->input('hi'),
            'ur' => $request->input('ur'),
            'fr' => $request->input('fr'),
        ]);


        if ($dish->save()) {

            $dish->printstations()->attach($request->input('printstation_ids'));
            return redirect()->to('/dish-price/' . $dish->id);
        }
    }

    /**
     * User can able to update dish by this method
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDish(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);
        $dish->dish = $request->get('dish');
        $dish->description = $request->get('description');
        $dish->category_id = $request->get('category_id');
        if ($request->hasFile('thumbnail')) {
            $img = $request->file('thumbnail');
            $filename = date("dmY-his") . $img->getClientOriginalName();
            $fulllink = 'media/images/library';
            Storage::disk('tenant')->put($fulllink . '/' . $filename, file_get_contents($img), 'public');
            $dish->thumbnail = $fulllink . '/' . $filename;
//            $dish->thumbnail = $request->file('thumbnail')
//                ->move('uploads/dish/thumbnail',
//                    rand(8000000, 99999999) . '.' . $request->thumbnail->extension());
        }
        $dish->user_id = auth()->user()->id;
        $dish->available = $request->get('available') == 'on' ? 1 : 0;

        $dish->translate('en')->dish = $request->input('en')['dish'];
        $dish->translate('ar')->dish = $request->input('ar')['dish'];
        $dish->translate('hi')->dish = $request->input('hi')['dish'];
        $dish->translate('ur')->dish = $request->input('ur')['dish'];
        $dish->translate('fr')->dish = $request->input('fr')['dish'];

        $dish->translate('en')->description = $request->input('en')['description'];
        $dish->translate('ar')->description = $request->input('ar')['description'];
        $dish->translate('hi')->description = $request->input('hi')['description'];
        $dish->translate('ur')->description = $request->input('ur')['description'];
        $dish->translate('fr')->description = $request->input('fr')['description'];


        if ($dish->save()) {
            $dish->printstations()->sync($request->input('printstation_ids'));
            return response()->json('Ok', 200);
        }
    }

    /**
     * This method will return a view there user can add dish prices by types
     * @param $dish_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addDishPrice($dish_id)
    {
        $dish = Dish::findOrFail($dish_id);
        return view('user.admin.dish.dish-price.add-dish-price', [
            'dish' => $dish
        ]);
    }

    /**
     * User can save dish prices by this method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveDishPrice(Request $request)
    {
        $dish_price = new DishPrice();
        $dish_price->dish_id = $request->get('dish_id');
        //$dish_price->dish_type = $request->get('dish_type');
        $dish_price->price = $request->get('price');
        $dish_price->user_id = auth()->user()->id;


        $dish_price->fill([
            'en' => $request->input('en'),
            'ar' => $request->input('ar'),
            'hi' => $request->input('hi'),
            'ur' => $request->input('ur'),
            'fr' => $request->input('fr'),

        ]);
        if ($dish_price->save()) {
            return redirect()->back();
        }

    }

    /**
     * This method will return a view there user can update dish prices by types
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editDishPrice($id)
    {
        $dish_price = DishPrice::findOrFail($id);
        return view('user.admin.dish.dish-price.edit-dish-price', [
            'dish_price' => $dish_price
        ]);
    }

    /**
     * User can update dish prices by this method
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDishPrice($id, Request $request)
    {
        $dish_price = DishPrice::findOrFail($id);
        $dish_price->dish_id = $request->get('dish_id');
        //$dish_price->dish_type = $request->get('dish_type');
        $dish_price->price = $request->get('price');
        $dish_price->user_id = auth()->user()->id;

        $dish_price->translate('en')->dish_type = $request->input('en')['dish_type'];
        $dish_price->translate('ar')->dish_type = $request->input('ar')['dish_type'];
        $dish_price->translate('hi')->dish_type = $request->input('hi')['dish_type'];
        $dish_price->translate('ur')->dish_type = $request->input('ur')['dish_type'];
        $dish_price->translate('fr')->dish_type = $request->input('fr')['dish_type'];

        if ($dish_price->save()) {
            return redirect()->to('/dish-price/' . $dish_price->dish->id);
        }
    }

    /**
     * This method will return a view there user can save dish images
     * @param $dish_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addDishImage($dish_id)
    {
        $dish = Dish::findOrFail($dish_id);
        return view('user.admin.dish.dish-image.add-dish-image', [
            'dish' => $dish
        ]);
    }

    /**
     * User can add dish images by this method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveDishImage(Request $request)
    {
        $dish_image = new DishInfo();
        $dish_image->title = $request->get('title');
        $dish_image->dish_id = $request->get('dish_id');
        $dish_image->user_id = auth()->user()->id;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $filename = date("dmY-his") . $img->getClientOriginalName();
            $fulllink = 'media/images/library';
            Storage::disk('tenant')->put($fulllink . '/' . $filename, file_get_contents($img), 'public');
            $dish_image->image = $fulllink . '/' . $filename;
//            $dish_image->image = $request->file('image')
//                ->move('uploads/dish/images',
//                    rand(8000000, 99999999) . '.' . $request->image->extension());
        }
        if ($dish_image->save()) {
            return redirect()->back();
        }
    }

    /**
     * This method will used to delete dish image
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteDishImage($id)
    {
        $dish_image = DishInfo::findOrFail($id);
        if ($dish_image->delete()) {
            return redirect()->back()->with('delete_success', 'Dish Image has been delete successfully....');
        }
    }


    public function addAdds($dish_id)
    {
        $dish = Dish::findOrFail($dish_id);
        $extras = Category::whereHas('translations', function ($q) {
            $q->where('name', 'extras')->where('locale', 'en');
        })->first();
        $side_dishes = Category::whereHas('translations', function ($q) {
            $q->where('name', 'side dishes')->where('locale', 'en');
        })->first();
        return view('user.admin.dish.dish-adds.add-dish-adds', [
            'dish' => $dish,
            'side_dishes' => $side_dishes,
            'extras' => $extras
        ]);
    }

    public function saveAdds(Request $request, $dish_id)
    {
        $dish_add = DishAdd::where('dish_id', $dish_id)->where('dish_add_id', $request->dish_add_id)->first();
        if (!$dish_add) {
            $dish_add = DishAdd::create(array_merge($request->input(), ['dish_id' => $dish_id]));
            if ($dish_add->save()) {
                return redirect()->to('/dish-adds/' . $dish_add->dish->id);
            }
        }
        return redirect()->back();

    }

    public function deleteAdds($id)
    {
        $dish_add = DishAdd::findOrFail($id);
        if ($dish_add->delete()) {
            return redirect()->back()->with('delete_success', 'Dish add has been delete successfully....');
        }
    }


    /**
     * This method will shoe the dish statistic page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dishStat()
    {
        $dishes = Dish::all();
        return view('user.admin.dish.stat.dish-stat', [
            'dishes' => $dishes
        ]);
    }

    /**
     * This method will redirect to the dish statistic url by requested query
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDishStat(Request $request)
    {
        $start_date = str_replace('/', '-', $request->get('start') != null ? $request->get('start') : "2017-09-01");
        $end_date = str_replace('/', '-', $request->get('end') != null ? $request->get('end') : Carbon::now()->format('Y-m-d'));
        $dish = $request->get('kitchen') == 0 ? 0 : $request->get('kitchen');
        return redirect()
            ->to('/dish-stat/dish=' . $dish . '/start=' . $start_date . '/end=' . $end_date);
    }

    /**
     * This method will show the statistic using the url query
     * @param $id
     * @param $start_date
     * @param $end_date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDishStat($id, $start_date, $end_date)
    {
        if ($id == 0) {

            $dishes = Dish::all();
            $dish_query = Dish::whereBetween('created_at', array($start_date . " 00:00:00", $end_date . " 00:00:00"))
                ->get();
            return view('user.admin.dish.stat.dish-stat-all', [
                'dishes' => $dishes,
                'dish_query' => $dish_query,
                'start' => $start_date,
                'end' => $end_date
            ]);
        } else {
            $dishes = Dish::all();
            $selected_dish = Dish::findOrFail($id);
            $dish_query = Dish::where('id', $id)
                ->whereBetween('created_at', array($start_date . " 00:00:00", $end_date . " 00:00:00"))
                ->get();
            return view('user.admin.dish.stat.dish-stat-selected', [
                'dishes' => $dishes,
                'selected_dish' => $selected_dish,
                'dish_query' => $dish_query,
                'start' => $start_date,
                'end' => $end_date
            ]);
        }
    }

    public function voidstat(Request $request)
    {
        if ($request->submit) {
            $request->flash();
            $voids = Voiddish::whereBetween('created_at', [$request->start, $request->end])
                ->with(['orderdetails_from'])
                ->with(['orderdetails_revived' => function ($q) {
                    $q->withTrashed();
                }])->get();;

            return view('user.admin.report.void')->with(compact('voids'));

        }
        return view('user.admin.report.void');
    }

    public function batchDish()
    {

        return view('user.admin.dish.batch-dish');
    }

    protected $excel_errors = array();

    public function storeBatchDish(Request $request)
    {
        $tenancy = app(Environment::class);
        if ($request->hasFile('excel')) {
            $excel = $request->file('excel');
            $filename = date("dmY-his") . $excel->getClientOriginalName();
            $fulllink = 'media/imports/library';
            Storage::disk('tenant')->put($fulllink . '/' . $filename, file_get_contents($excel), 'public');

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $filename_images = date("dmY-his") . $images->getClientOriginalName();
                $fulllink_images = 'media/images/library';
                Storage::disk('tenant')->put($fulllink_images . '/' . $filename_images, file_get_contents($images), 'public');
            }

            $zip = new ZipArchive();
            if ($zip->open(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink_images . '/' . $filename_images)) === TRUE) {
                $zip->extractTo(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink_images));
                $zip->close();
            }

            Excel::load(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink . '/' . $filename), function ($reader) {

                for ($i = 0; $i < count($reader->all()); $i++) {

                    if ($reader->all()[$i]->getTitle() == 'Dishes') {
                        $j=1;
                        foreach ($reader->all()[$i] as $item) {

                            $dish = Dish::whereHas('translations', function ($q) use ($item) {
                                $q->where('dish', $item->en_dish);
                            })->first();

                            if (!$dish) {
                                $dish = new Dish();
                                $dish->dish = '';
                                $dish->description = '';
                                $category = Category::whereHas('translations', function ($q) use ($item) {
                                    $q->where( function ( $q2 ) use ( $item ) {
                                        $q2->whereRaw( 'LOWER(`name`) like ?', strtolower($item->category_name ) );
                                    });
                                })->first();
                                if ($category)
                                    $dish->category_id = $category->id;
                                else{
                                    $this->excel_errors[]=['index'=>$j,'col_name'=>'category_name','sheat_name'=>'dish'];
                                }
                                if($item->image)
                                    $dish->thumbnail = 'media/images/library/'.$item->image;
                                else
                                    $dish->thumbnail = 'img/no image.jpeg';
                                  $dish->user_id = auth()->user()->id;
                                $dish->fill([
                                    'en' => ['dish' => $item->en_dish, 'description' => $item->en_description],
                                    'ar' => ['dish' => $item->ar_dish, 'description' => $item->ar_description],
                                    'hi' => ['dish' => $item->hi_dish, 'description' => $item->hi_description],
                                    'ur' => ['dish' => $item->ur_dish, 'description' => $item->ur_description],
                                    'fr' => ['dish' => $item->fr_dish, 'description' => $item->fr_description],
                                ]);
                                $dish->save();
                                $j++;
                            }
                        }

                    } else if ($reader->all()[$i]->getTitle() == 'Dish type') {
                        $j=1;

                        foreach ($reader->all()[$i] as $item) {
                            $dish = Dish::whereHas('translations', function ($q) use ($item) {
                                $q->where('dish', $item->en_dish);
                            })->first();
                            if(!$dish){
                                $this->excel_errors[]=['index'=>$j,'col_name'=>'en_dish','sheat_name'=>'dish type'];

                            }
                            else{
                            $dish_price = DishPrice::where('dish_id', $dish->id)->whereHas('translations', function ($q) use ($item) {
                                $q->where('dish_type', $item->en_dish_type);
                            })->first();
                            if (!$dish_price) {
                                $dish_price = new DishPrice();
                                $dish_price->dish_id = $dish->id;
                                $dish_price->price = $item->price;
                                $dish_price->user_id = auth()->user()->id;

                                $dish_price->fill([
                                    'en' => ['dish_type' => $item->en_dish_type],
                                    'ar' => ['dish_type' => $item->ar_dish_type],
                                    'hi' => ['dish_type' => $item->hi_dish_type],
                                    'ur' => ['dish_type' => $item->ur_dish_type],
                                    'fr' => ['dish_type' => $item->fr_dish_type],
                                ]);
                                $dish_price->save();
                            }
                        }

                            $j++;
                        }
                    } else if ($reader->all()[$i]->getTitle() =='Recipies') {

                        $j=1;
                        foreach ($reader->all()[$i] as $item) {
//                            dd($reader->all()[$i]);
                            $dish = Dish::whereHas('translations', function ($q) use ($item) {
                                $q->where('dish', $item->en_dish);
                            })->first();
                            $dish_price = DishPrice::where('dish_id', $dish->id)->whereHas('translations', function ($q) use ($item) {
                                $q->where('dish_type', $item->en_dish_type);
                            })->first();

                            if(!$dish){

                                $this->excel_errors[]=['index'=>$j,'col_name'=>'en_dish','sheat_name'=>'Recipies'];

                            }
                            if(!$dish_price){
                                $this->excel_errors[]=['index'=>$j,'col_name'=>'en_dish_type','sheat_name'=>'Recipies'];
                            }

                            $product = Product::where( function ( $q2 ) use ( $item ) {
                                $q2->whereRaw( 'LOWER(`product_name`) like ?',strtolower($item->product_name ) );
                            })->first();
                            $existRecipe = false;
                            if ($product &&$dish &&$dish_price) {
                                $existRecipe = Recipe::where('dish_type_id', $dish->id)
                                    ->where('product_id', $product->id)
                                    ->first();
                            }
                            if (!$existRecipe) {
                                $recipe = new Recipe();
                                $recipe->dish_id = $dish->id;
                                $recipe->dish_type_id = $dish_price->id;
                                if ($product) {
                                    $recipe->product_id = $product->id;
                                }
                                $recipe->unit_needed = $item->unit;
                                $recipe->child_unit_needed = $item->child_unit;
                                $recipe->user_id = auth()->id();
                                $recipe->save();
                            }
                       $j++;
                        }
                    } else if ($reader->all()[$i]->getTitle() =='adds (optional)') {
$j=0;
                        foreach ($reader->all()[$i] as $item) {
                            if ($item->en_dish) {
                                $dish_old = Dish::whereHas('translations', function ($q) use ($item) {
                                    $q->where('dish', $item->en_dish);
                                })->first();
                                $dish_add_old = Dish::whereHas('translations', function ($q) use ($item) {
                                    $q->where('dish', $item->en_dish_add);
                                })->first();

                                if(!$dish_old){
                                    $this->excel_errors[]=['index'=>$j,'col_name'=>'en_dish','sheat_name'=>'Recipies'];

                                }
                                if(!$dish_add_old){
                                    $this->excel_errors[]=['index'=>$j,'col_name'=>'en_dish_add','sheat_name'=>'adds'];
                                }

                                $dish_addres = false;
                                if ($dish_add_old && $dish_old)
                                    $dish_addres = DishAdd::where('dish_id', $dish_old->id)->where('dish_add_id', $dish_add_old->id)->first();


                                if (!$dish_addres) {

                                    $dish_add = new DishAdd();
                                    $dish_add->dish_id = $dish_old->id;
                                    $dish_add->dish_add_id = $dish_add_old->id;
                                    $dish_add->type = $item->type;
                                    $dish_add->save();


                                }
                            }
                            $j++;
                        }
                    }
                }
            });
        }
        if (count($this->excel_errors) > 0) {
            $excel_errors = $this->excel_errors;
            return view('user.admin.dish.batch-dish')->with(compact('excel_errors'));
        } else {

            return redirect('all-dish');
        }
    }

    public function downloaddishsample()
    {
        $pathToFile = public_path('sample/Batch Dish Sample.xlsx');
        return response()->download($pathToFile);

    }
}
