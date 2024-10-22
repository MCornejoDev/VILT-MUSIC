<div class="flex flex-col gap-2">
    <?php if (existsMessageInBag()): ?>
        <?php foreach (getMessagesBag() as $key => $value) : ?>
            <div class="text-base font-bold text-center text-green-600">
                <?php __($value) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>