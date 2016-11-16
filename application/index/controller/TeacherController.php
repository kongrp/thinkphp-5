<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹
use think\Controller;               // 用于与V层进行数据传递
use app\common\model\Teacher;       // 教师模型
/**
 * 教师管理
 */
class TeacherController extends Controller
{
    public function index()
    {
        // $Teacher 首写字大写，说明它是一个对象, 更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
        $Teacher = new Teacher; 

        // $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
        $teachers = $Teacher->select();

        // 向V层传数据
        $this->assign('teachers', $teachers);
        // 取回打包后的数据
        $htmls = $this->fetch();
        // 将数据返回给用户
        return $htmls;
    }
}