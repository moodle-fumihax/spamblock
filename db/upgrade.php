<?php
function xmldb_auth_spamblockbeta_upgrade($oldversion): bool {
    global $CFG, $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

    if ($oldversion < 2022061207) {

        // Define table auth_spamblockbeta to be created.
        $table = new xmldb_table('auth_spamblockbeta');

        // Adding fields to table auth_spamblockbeta.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('logintoken', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('answer', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table auth_spamblockbeta.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch drop table for auth_spamblockbeta.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Conditionally launch create table for auth_spamblockbeta.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Spamblockbeta savepoint reached.
        upgrade_plugin_savepoint(true, 2022061207 , 'auth', 'spamblockbeta');
    }


    return true;
}