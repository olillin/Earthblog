<?php require_once './config.php' ?>

<label class="block m-bottom__xs"
       for="<?= Prop('name', Prop('id')) ?>">
       <?= Prop('label') ?>
</label>
<input class="block border-2 border-gray-500 rounded"
       type="<?= Prop('type', 'text') ?>"
       name="<?= Prop('name', Prop('id')) ?>"
       id="<?= Prop('id', Prop('name')) ?>">