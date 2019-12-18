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
        'email' => $this->string()->notNull(),
        'text_message' => $this->text(),
        'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `user_id`
    $this->createIndex(
        'idx-contact-user_id',
        'contact',
        'user_id'
    );

    // add foreign key for table `user`
    $this->addForeignKey(
        'fk-contact-user_id',
        'contact',
        'user_id',
        'user',
        'id',
        'CASCADE',
        'CASCADE'
    );

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
