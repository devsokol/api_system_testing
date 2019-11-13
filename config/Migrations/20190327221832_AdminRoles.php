<?php
use Migrations\AbstractMigration;

class AdminRoles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('admin_roles');

        if (!$table->exists()) {
            $table
                ->addColumn('title', 'string', [
                    'limit' => 100
                ])
                ->addTimestamps('created', 'modified')
                ->create();
        }
    }
}
