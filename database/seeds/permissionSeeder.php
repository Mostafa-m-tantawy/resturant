<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

  Permission::create([ 'name'=> 'index unit'    ]);
  Permission::create([ 'name'=> 'create unit'    ]);
  Permission::create([ 'name'=> 'update unit'     ]);
  Permission::create([ 'name'=> 'delete unit'      ]);


  Permission::create([ 'name'=> 'index supplier'    ]);
  Permission::create([ 'name'=> 'create supplier'   ]);
  Permission::create([ 'name'=> 'update supplier'   ]);
  Permission::create([ 'name'=> 'show supplier'     ]);
  Permission::create([ 'name'=> 'delete supplier'   ]);

  Permission::create([ 'name'=> 'index product'	]);
  Permission::create([ 'name'=> 'create product'	]);
  Permission::create([ 'name'=> 'show product'	]);
  Permission::create([ 'name'=> 'update product'	]);
  Permission::create([ 'name'=> 'delete product'	]);
  Permission::create([ 'name'=> 'attach product to supplier'	]);
  Permission::create([ 'name'=> 'detach product to supplier'	]);


  Permission::create([ 'name'=> 'index product category'	   ]);
  Permission::create([ 'name'=> 'create product category']);
  Permission::create([ 'name'=> 'update product category']);
  Permission::create([ 'name'=> 'delete product category']);

  Permission::create([ 'name'=> 'index department'	]);
  Permission::create([ 'name'=> 'create department'	]);
  Permission::create([ 'name'=> 'show department'	]);
  Permission::create([ 'name'=> 'update department'	]);
  Permission::create([ 'name'=> 'stock department'	]);

  Permission::create([ 'name'=> 'index restaurant'	]);
  Permission::create([ 'name'=> 'create restaurant'	]);
  Permission::create([ 'name'=> 'show restaurant'	]);
  Permission::create([ 'name'=> 'update restaurant'	]);
  Permission::create([ 'name'=> 'stock restaurant'	]);


  Permission::create([ 'name'=> 'create purchase'		]);
  Permission::create([ 'name'=> 'update purchase'	]);
  Permission::create([ 'name'=> 'summery purchase'	]);
  Permission::create([ 'name'=> 'details purchase'	]);


  Permission::create([ 'name'=> 'index refund'		]);
  Permission::create([ 'name'=> 'create refund'		]);
  Permission::create([ 'name'=> 'delete refund'		]);

  Permission::create([ 'name'=> 'index assign stock'		]);
  Permission::create([ 'name'=> 'create assign stock'		]);


  Permission::create([ 'name'=> 'index ruined product'		]);
  Permission::create([ 'name'=> 'create ruined product'		]);
  Permission::create([ 'name'=> 'delete ruined product'		]);


  Permission::create([ 'name'=> 'create stock payment']);
  Permission::create([ 'name'=> 'delete stock payment' ]);

  Permission::create([ 'name'=> 'index table'			]);
  Permission::create([ 'name'=> 'create table'			]);
  Permission::create([ 'name'=> 'update table'			]);


  Permission::create([ 'name'=> 'index hall'             ]);
  Permission::create([ 'name'=> 'create hall'            ]);
  Permission::create([ 'name'=> 'update hall'            ]);

  Permission::create([ 'name'=> 'index coupon'             ]);
  Permission::create([ 'name'=> 'create coupon'            ]);
  Permission::create([ 'name'=> 'update coupon'            ]);
  Permission::create([ 'name'=> 'delete coupon'            ]);


  Permission::create([ 'name'=> 'life kitchen'           ]);

  Permission::create([ 'name'=> 'create order payment'   ]);
  Permission::create([ 'name'=> 'delete order payment'   ]);

  Permission::create([ 'name'=> 'pos hall index'         ]);
  Permission::create([ 'name'=> 'pos hall transfer'      ]);
  Permission::create([ 'name'=> 'post hall merge'        ]);

  Permission::create([ 'name'=> 'create order'           ]);
  Permission::create([ 'name'=> 'update order'           ]);
  Permission::create([ 'name'=> 'delete order'           ]);
  Permission::create([ 'name'=> 'close order'           ]);

  Permission::create([ 'name'=> 'print client'           ]);
  Permission::create([ 'name'=> 'print department'       ]);

  Permission::create([ 'name'=> 'index asset'            ]);
  Permission::create([ 'name'=> 'create asset'           ]);
  Permission::create([ 'name'=> 'show asset'             ]);
  Permission::create([ 'name'=> 'update asset'           ]);
  Permission::create([ 'name'=> 'delete asset'           ]);
  Permission::create([ 'name'=> 'attach employee asset'  ]);
  Permission::create([ 'name'=> 'detach employee asset'  ]);

  Permission::create([ 'name'=> 'index leave'            ]);
  Permission::create([ 'name'=> 'create leave'          ]);
  Permission::create([ 'name'=> 'delete leave'           ]);

  Permission::create([ 'name'=> 'index leave type'       ]);
  Permission::create([ 'name'=> 'create leave type'      ]);
  Permission::create([ 'name'=> 'update leave type'      ]);

  Permission::create([ 'name'=> 'index payroll'          ]);
  Permission::create([ 'name'=> 'create payroll'         ]);
  Permission::create([ 'name'=> 'delete payroll'         ]);

  Permission::create([ 'name'=> 'index payroll type'     ]);
  Permission::create([ 'name'=> 'create payroll type'    ]);
  Permission::create([ 'name'=> 'delete payroll type'    ]);

  Permission::create([ 'name'=> 'index pay slip'         ]);
  Permission::create([ 'name'=> 'create pay slip'        ]);
  Permission::create([ 'name'=> 'show pay slip'         ]);
  Permission::create([ 'name'=> 'update pay slip'        ]);
  Permission::create([ 'name'=> 'delete pay slip'        ]);


  Permission::create([ 'name'=> 'index shift'            ]);
  Permission::create([ 'name'=> 'create shift'           ]);
  Permission::create([ 'name'=> 'update shift'           ]);
  Permission::create([ 'name'=> 'attach shift employee'  ]);
  Permission::create([ 'name'=> 'detach shift employee'  ]);
  Permission::create([ 'name'=> 'index shift employee'   ]);

  Permission::create([ 'name'=> 'index shift hour'       ]);
  Permission::create([ 'name'=> 'create shift hour'      ]);
  Permission::create([ 'name'=> 'update shift hour'      ]);

  Permission::create([ 'name'=> 'index employee'         ]);
  Permission::create([ 'name'=> 'create employee'        ]);
  Permission::create([ 'name'=> 'show employee'          ]);
  Permission::create([ 'name'=> 'update employee'        ]);

  Permission::create([ 'name'=> 'index earning type'     ]);
  Permission::create([ 'name'=> 'create earning type'    ]);
  Permission::create([ 'name'=> 'update earning type'    ]);

  Permission::create([ 'name'=> 'index earning'          ]);
  Permission::create([ 'name'=> 'create earning'         ]);
  Permission::create([ 'name'=> 'update earning'         ]);

  Permission::create([ 'name'=> 'create employee emergency']);
  Permission::create([ 'name'=> 'update employee emergency']);
  Permission::create([ 'name'=> 'delete employee emergency']);

  Permission::create([ 'name'=> 'index attendance'          ]);
  Permission::create([ 'name'=> 'update attendance'          ]);
  Permission::create([ 'name'=> 'history attendance'         ]);
  Permission::create([ 'name'=> 'check in attendance'        ]);
  Permission::create([ 'name'=> 'check out attendance'      ]);

  Permission::create([ 'name'=> 'index approve type' ]);
  Permission::create([ 'name'=> 'create approve type' ]);
  Permission::create([ 'name'=> 'update approve type'  ]);

  Permission::create([ 'name'=> 'my requests'           ]);
  Permission::create([ 'name'=> 'my approves'            ]);
  Permission::create([ 'name'=> 'response approve'                ]);

  Permission::create([ 'name'=> 'index approver'             ]);
  Permission::create([ 'name'=> 'create approver'            ]);
  Permission::create([ 'name'=> 'update approver'            ]);
  Permission::create([ 'name'=> 'destroy approver'           ]);

  Permission::create([ 'name'=> 'index holiday'    ]);
  Permission::create([ 'name'=> 'create holiday'            ]);
  Permission::create([ 'name'=> 'update holiday'             ]);
  Permission::create([ 'name'=> 'destroy holiday'            ]);

  Permission::create([ 'name'=> 'index dish category'       ]);
  Permission::create([ 'name'=> 'create dish category'       ]);
  Permission::create([ 'name'=> 'update dish category'       ]);

  Permission::create([ 'name'=> 'index dish'                 ]);
  Permission::create([ 'name'=> 'create dish'                ]);
  Permission::create([ 'name'=> 'update dish'                ]);

  Permission::create([ 'name'=> 'index ruined dish'          ]);
  Permission::create([ 'name'=> 'create ruined dish'         ]);
  Permission::create([ 'name'=> 'delete ruined dish'         ]);
//
  Permission::create([ 'name'=> 'index dish size'            ]);
  Permission::create([ 'name'=> 'create dish size'           ]);
  Permission::create([ 'name'=> 'update dish size'           ]);
//
  Permission::create([ 'name'=> 'index extra dish'           ]);
  Permission::create([ 'name'=> 'create extra dish'          ]);
  Permission::create([ 'name'=> 'delete extra dish'          ]);
//
//
  Permission::create([ 'name'=> 'index side dish'            ]);
  Permission::create([ 'name'=> 'create side dish'           ]);
  Permission::create([ 'name'=> 'delete side dish'           ]);
//]);
//
  Permission::create([ 'name'=> 'index dish recipe'          ]);
  Permission::create([ 'name'=> 'create dish recipe'         ]);
  Permission::create([ 'name'=> 'delete dish recipe'         ]);
//]);
  Permission::create([ 'name'=> 'index order cost'           ]);
  Permission::create([ 'name'=> 'system configuration']);
//
  Permission::create([ 'name'=> 'index role']);
  Permission::create([ 'name'=> 'create role']);
  Permission::create([ 'name'=> 'update role']);
  Permission::create([ 'name'=> 'delete role']);
  Permission::create([ 'name'=> 'associate role employee']);
  Permission::create([ 'name'=> 'dissociate role employee']);
//

  Permission::create([ 'name'=> 'index Permission']);
  Permission::create([ 'name'=> 'create Permission']);
  Permission::create([ 'name'=> 'update Permission']);
  Permission::create([ 'name'=> 'delete Permission']);
  Permission::create([ 'name'=> 'associate Permission role']);
  Permission::create([ 'name'=> 'dissociate Permission role']);
//
  Permission::create([ 'name'=> 'index expense']);
  Permission::create([ 'name'=> 'create expense']);
  Permission::create([ 'name'=> 'delete expense']);
//
  Permission::create([ 'name'=> 'index client']);
  Permission::create([ 'name'=> 'create client']);
  Permission::create([ 'name'=> 'update client']);
//
  Permission::create([ 'name'=> 'create client payment']);
  Permission::create([ 'name'=> 'delete client payment']);
////
  Permission::create([ 'name'=> 'index transfer money']);
  Permission::create([ 'name'=> 'index received money']);
  Permission::create([ 'name'=> 'request transfer money']);
  Permission::create([ 'name'=> 'response received money']);
//
  Permission::create([ 'name'=> 'pos dashboard']);
  Permission::create([ 'name'=> 'hr dashboard']);
  Permission::create([ 'name'=> 'stock dashboard']);
  Permission::create([ 'name'=> 'cost dashboard']);



    }
}
