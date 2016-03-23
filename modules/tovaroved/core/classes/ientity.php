<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 19.09.12
 * Time: 11:55
 * To change this template use File | Settings | File Templates.
 */
interface IEntity
{
    public static function instance();

    public function create($data, $files);

    public function update($id, $data, $files);

    public function delete($id);
}
