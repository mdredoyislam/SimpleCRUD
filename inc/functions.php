<?php
define('DB_NAME', '/LaragonServer/laragon/www/Laravel/CRUD/data/db.txt');

function seed(){
    $data = array(
        array(
            'id'    => 1,
            'fname' => 'Kamal',
            'lname' => 'Ahmed',
            'roll'  => '11',
        ),
        array(
            'id'    => 2,
            'fname' => 'Jamal',
            'lname' => 'Ahmed',
            'roll'  => '12',
        ),
        array(
            'id'    => 3,
            'fname' => 'Ripon',
            'lname' => 'Ahmed',
            'roll'  => '9',
        ),
        array(
            'id'    => 4,
            'fname' => 'Nikil',
            'lname' => 'Chandra',
            'roll'  => '8',
        ),
        array(
            'id'    => 5,
            'fname' => 'John',
            'lname' => 'Rozario',
            'roll'  => '7',
        ),
        array(
            'id'    => 6,
            'fname' => 'Redoy',
            'lname' => 'Islam',
            'roll'  => '1',
        ),
        array(
            'id'    => 7,
            'fname' => 'Web',
            'lname' => 'Developer',
            'roll'  => '2',
        ),
    );

    $serializeData = serialize($data);
    file_put_contents(DB_NAME, $serializeData, LOCK_EX);
}

function generateReport(){
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
     ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Roll</th>
            <th>Action</th>
        </tr>
        <?php
        foreach($students as $student){
        ?>
        <tr>
            <td><?php printf('%s %s',$student['fname'],$student['lname']); ?></td>
            <td><?php printf('%s',$student['roll']); ?></td>
            <td><?php printf('<a href="/CRUD/index.php?task=edit&id=%s">Edit</a> | <a href="/CRUD/index.php?task=delete&id=%s">Delete</a>', $student['id'],$student['id']); ?></td>
        </tr>
        <?php } ?>
    </table>
     <?php
}

function addStudent($fname, $lname, $roll){
    $found = false;
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
    foreach($students as $_student){
        if($_student['roll'] == $roll){
            $found = true;
            break;
        }
    }
    if(!$found){
        $newId = count($students)+1;
        $student = array(
            'id'    =>$newId,
            'fname' =>$fname,
            'lname' =>$lname,
            'roll'   =>$roll,
        );
        array_push($students, $student);
        $serializeData = serialize($students);
        file_put_contents(DB_NAME, $serializeData, LOCK_EX);
        return true;
    }
    return false;
}