<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">
    <div class="site-error">

    <h1>Không tìm thấy (#404)</h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            Đã có lỗi xảy ra khi Web server đang xử lý yêu cầu của bạn!.
        </p>
        <p>
            Vui lòng liên lạc vs chúng tôi nếu bạn nghĩ đây là lỗi do server. Cảm ơn bạn!
        </p>

    </div>
</div>
