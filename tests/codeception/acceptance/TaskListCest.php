<?php


class TaskListCest
{
    public function showsEmptyMessage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('You have no tasks. Enjoy your day!');
        $I->seeNumRecords(0 , 'tasks');
    }

    public function showsPreviouslyAddedTasks(AcceptanceTester $I)
    {
        $I->haveInDatabase('tasks', [
            'note' => 'This is my first task',
            'created' => '2016-11-11'
        ]);
        $I->haveInDatabase('tasks', [
            'note' => 'This is my second task',
            'created' => '2016-11-12'
        ]);

        $I->amOnPage('/');
        $I->see('This is my second task');
        $I->see('This is my first task');
    }

    public function addsTask(AcceptanceTester $I)
    {
        $I->seeNumRecords(0 , 'tasks');
        $I->amOnPage('/');
        $I->fillField('task_note', 'Start Testing PHP');
        $I->click('Add');
        $I->amOnPage('/');
        $I->see('Start Testing PHP', 'li');
        $I->seeNumRecords(1, 'tasks');
        $I->seeInDatabase('tasks', ['note' => 'Start testing PHP']);
    }
}
