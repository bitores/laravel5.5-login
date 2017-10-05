<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->unique();
			$table->string('email', 191)->nullable()->unique();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->boolean('activated')->nullable()->default(0)->comment('是否激活 1 激活 0未激活');
			$table->string('token', 191)->nullable();
			$table->string('signup_ip_address', 45)->nullable();
			$table->string('signup_confirmation_ip_address', 45)->nullable();
			$table->string('signup_sm_ip_address', 45)->nullable();
			$table->string('admin_ip_address', 45)->nullable();
			$table->string('updated_ip_address', 45)->nullable();
			$table->string('deleted_ip_address', 45)->nullable();
			$table->boolean('inner')->nullable()->default(0)->comment('公司内部人员 是1   否0 ');
			$table->integer('leader_id')->unsigned()->nullable()->comment('上级id');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
