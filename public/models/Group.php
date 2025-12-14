<?php
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/Student.php';
class Group extends Model
{
    protected static $table = "groups";
    public function students(): array
    {
        return $this->hasMany("Student", "group_id");
    }
}
