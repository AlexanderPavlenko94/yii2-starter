<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mail_template`.
 * Has foreign keys to the tables:
 *
 */
class m161114_123235_create_mail_template_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mail_template', [
            'id' => $this->primaryKey(),
            'body' => $this->text(),
            'name' => $this->string(250)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'subject' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mail_template');
    }
}
