<?php

namespace App\Http\Middleware;

use Closure;

class checkAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * tham số $request là phía yêu cầu từ client gửi lên
         * tham số Clouse truyền tham số $next kiểm trả trước cái request có quyền thực thi hay không ?
         *
         * Before middleware : sẽ kiểm tra trước khi bước vào cửa.
         * After middleware : cho vào phòng đợi, kiểm tra xác thực lại lần nữa đúng thì cho vào - sai cho đi ra.
         * */

        // before middleware : kiểm tra trước, mới cho phép kiểm tra tiếp các request tiếp theo
        $age = $request->age;
        if($age < 18){
            // quay về trang khong-duoc-xem
            return redirect(route('khongduocxem'));
        }
        // after middleware : tiếp tục thực thi các request tiếp theo

        return $next($request);
    }
}
