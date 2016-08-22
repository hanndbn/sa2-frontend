<?php use yii\helpers\Url; ?>
<div class="col-md-9">
    <div class="container fixcontainer" style="margin-top: 10px; margin-bottom: 60px; ">
        <div
            style="border: 1px solid #ccc; border-radius: 4px; overflow: hidden; border-top-right-radius:0;border-top-left-radius:0;">
            <div id="container" class="list-tv">

            </div>
            <div id="loading" style="text-align:center"></div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
<script src="../js/react-with-addons.js"></script>
<script type="text/babel" src="<?= Yii::$app->request->baseUrl ?>/js/appUser.js">
