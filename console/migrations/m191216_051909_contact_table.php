<?php

use yii\db\Migration;

/**
 * Class m191216_051909_contact_table
 */
class m191216_051909_contact_table extends Migration
{
public function safeUp()
{
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('contact', [
        'id' => $this->primaryKey(),
        'name' => $this->string()->notNull(),
        'sur_name' => $this->string()->notNull(),
        'phone_number' => $this->string()->notNull(),
        'email' => $this->string()->notNull()->unique(),
        'text_message' => $this->string(),
        'user_id' => $this->string()->notNull(),
        ], $tableOptions);

}


public function safeDown()
{
        $this->dropTable('contact');


}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191216_051909_contact_table cannot be reverted.\n";

        return false;
    }
    */
}
