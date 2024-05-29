<label for="<?= Prop('name', Prop('id')) ?>">
       <?= Prop('label') ?>
</label>
<input type="<?= Prop('type', 'text') ?>"
       name="<?= Prop('name', Prop('id')) ?>"
       id="<?= Prop('id', Prop('name')) ?>">