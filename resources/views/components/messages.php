<div class="flex flex-col gap-2">
    <?php if (hasValuesInBag('messages')): ?>
        <?php foreach ($_SESSION['messages'] as $key => $value) : ?>
            <?php if ($key === 'error'): ?>
                <div class="text-base font-bold text-center text-red-600">
                    <?php __($value) ?>
                </div>
            <?php elseif ($key === 'success'): ?>
                <div class="text-base font-bold text-center text-green-600">
                    <?php __($value) ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>