<?php

class Create_Profiles_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creating the table
		Schema::create('profiles', function($table) {
			$table->on('application_schema');
			$table->increments('id');
			$table->string('first_name', 30)->default('');
			$table->string('last_name', 30)->default('');
			$table->string('username', 30)->default('');
			$table->integer('type');
			$table->string('email', 70)->default('')->unique();
			$table->string('password', 70)->default('');
			$table->timestamps();
			$table->index('type');
			$table->engine = 'InnoDB';
		});

		// Adding some records
		DB::connection('application_schema')
			->table('profiles')
			->insert(array(
				'first_name' => 'Thommy',
				'last_name' => 'Thompson',
				'username' => 't.thompson',
				'type' => 1,
				'email' => 'thommy@thompson.com',
				'password' => Hash::make('test'),
				'created_at' => DB::raw('NOW()'),
				'updated_at' => DB::raw('NOW()'),
			));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}