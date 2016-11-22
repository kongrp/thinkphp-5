<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹
use think\Controller;               // 用于与V层进行数据传递
use app\common\model\Teacher;       // 教师模型
use think\Request;            // 引用Request
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

    public function insert()
    {
        // 接收传入数据
        $postData = Request::instance()->post();    

        // 实例化Teacher空对象
        $Teacher = new Teacher();

        // 为对象赋值
        $Teacher->name = $postData['name'];
        $Teacher->username = $postData['username'];
        $Teacher->sex = $postData['sex'];
        $Teacher->email = $postData['email'];

        // 新增对象至数据表
         $result = $Teacher->validate(true)->save();

        // 反馈结果
        if(false === $result)
        {
            return '新增失败:' . $Teacher->getError();
        } else {
            return  '新增成功。新增ID为:' . $Teacher->id;
        }
    }

    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }

    public function delete()
    {
        // 获取get数据
        var_dump(Request::instance()->get());
        return;

        // 获取要删除的对象
        $Teacher = Teacher::get(14);

        // 要删除的对象存在
        if (!is_null($Teacher)) {
            // 删除对象
            if ($Teacher->delete()) {
                return '删除成功';
            }
        }

        return '删除失败';
    }
}