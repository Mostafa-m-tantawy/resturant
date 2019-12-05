var order=[];
var dish={id:1,name:'ddd',size:{},side:[],extra:[]};
var side=[];
var extra=[];



function newDish(id,name) {

    dish={
        id:id, name:name};
    return [
        {id:1, name:'small', price:10},
    {id:2, name:'medium', price:15},
    {id:3, name:'large', price:20},
    ];


    //
    // var formdata = new FormData();
    // formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    // $.ajax({
    //     url: '/save-purses',
    //     type: "POST",
    //     data: formdata,
    //     processData: false,
    //     contentType: false,
    //     success: function (data) {
    //     },
    //     error: function (data) {
    //     },
    // });


}
function DishSizes(dish_id,id,name,price) {

    $('#sizes_modal').modal('toggle');
    $('#sides_modal').modal('toggle');


    dish.size={id:id,name:name,price:price};
    return [{id:1, name:'ris'},
        {id:2, name:'pasta'},
        {id:3, name:'coca'},
    ];
}

function DishSides(dish_id,ids,names) {

   $('#extra_modal').modal('toggle');
    $('#sides_modal').modal('toggle');
console.log(ids);
    for(var i=0;i<ids.length;i++){
        dish.side.push({id:ids[i],name:names[i]});
    }
    return [{id:1, name:'cheeas',price:10},
        {id:2, name:'onion',price:11},
        {id:3, name:'salad',price:12},
    ];

}
function DishExtra(dish_id,ids,names,prices) {
    console.log(ids);

    $('#extra_modal').modal('toggle');

    for(var i=0;i<ids.length;i++){
        dish.extra.push({id:ids[i],name:names[i],price:prices[i]});
    }
    console.log(dish);
    // return dish;
}
