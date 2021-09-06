<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CrudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Category CRUD
    	if (\DB::table('cruds')->where('model', 'Category')->doesntExist()) 
    	{
    		\DB::table('cruds')->insert(
	        	[
	        	'name'       => 'category',
	        	'model'      => 'Category',
	        	'route'      => 'categories',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	]       	  
    		);
    	}
        
        // Author CRUD
    	if (\DB::table('cruds')->where('model', 'Author')->doesntExist())
    	{
    		\DB::table('cruds')->insert(
	    		[
	        	'name'       => 'author',
	        	'model'      => 'Author',
	        	'route'      => 'authors',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	]
    		);
    	} 
    		
    	// Translator CRUD
    	if (\DB::table('cruds')->where('model', 'Translator')->doesntExist())
		{
			\DB::table('cruds')->insert(
	    		[
	        	'name'       => 'translator',
	        	'model'      => 'Translator',
	        	'route'      => 'translators',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	]
    		);
		}
    	
    	// Publisher CRUD
		if (\DB::table('cruds')->where('model', 'Publisher')->doesntExist())
		{
			\DB::table('cruds')->insert(
	    		[
	        	'name'       => 'publisher',
	        	'model'      => 'Publisher',
	        	'route'      => 'publishers',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	],
    		);
		}
    	
    	// Book CRUD
		if (\DB::table('cruds')->where('model', 'Book')->doesntExist())
		{
			\DB::table('cruds')->insert(
	    		[
	        	'name'       => 'book',
	        	'model'      => 'Book',
	        	'route'      => 'books',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	],
    		);
		}

		// User CRUD
		if (\DB::table('cruds')->where('model', 'User')->doesntExist())
		{
			\DB::table('cruds')->insert(
	    		[
	        	'name'       => 'user',
	        	'model'      => 'User',
	        	'route'      => 'users',
	        	'active'     => true,
	        	'built'      => true,
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        	],
    		);
		}
    	
    }
}
