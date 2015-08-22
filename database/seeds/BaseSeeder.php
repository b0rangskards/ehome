<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

abstract class BaseSeeder extends Seeder {

	protected function seedTables()
	{
		$this->setForeignKeyChecks(false);
		$this->setSQLMode();

		foreach ( $this->tables as $tableName ) {
			$tableNameFormatted = strpos($tableName, '_') !== false
				? Str::title($tableName)
				: ucfirst(Str::camel($tableName));

			$tableSeeder = $tableNameFormatted . 'TableSeeder';

			$this->call($tableSeeder);
		}

		$this->setForeignKeyChecks(true);
	}

	protected function cleanDatabase()
	{
		$this->setForeignKeyChecks(false);

		foreach ( $this->tables as $tableName ) {
			DB::table($tableName)->truncate();
		}

		$this->setForeignKeyChecks(true);
	}

	protected function setSQLMode($value = 'NO_AUTO_VALUE_ON_ZERO')
	{
		if ( $this->isMySQL() ) {
			DB::statement('SET sql_mode = ' . $value);
		}
	}

	protected function setForeignKeyChecks($enable = true)
	{
		if ( $this->isSQLite() ) {
			$statement = 'PRAGMA foreign_keys=' . ($enable ? '1' : '0');
			DB::statement(DB::raw($statement));
			return;
		}

		$statement = 'SET FOREIGN_KEY_CHECKS=' . ($enable ? '1' : '0');
		DB::statement($statement);
	}

	/**
	 * @return bool
	 */
	protected function isSQLite()
	{
		return DB::getDriverName() === 'sqlite';
	}

	/**
	 * @return bool
	 */
	protected function isMySQL()
	{
		return DB::getDriverName() === 'mysql';
	}
} 