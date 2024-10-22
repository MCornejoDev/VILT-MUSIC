<label class="ml-2" for="image"><? __('user.image') ?></label>

<div>
    <?php if ($label): ?>
        <?php if (existsErrorInBag($name)): ?>
            <label for="<?= htmlspecialchars($id); ?>" class="block font-medium text-red-600">
                <?= __($label); ?>
            </label>
        <?php else: ?>
            <label for="<?= htmlspecialchars($id); ?>" class="block font-medium">
                <?= __($label); ?>
            </label>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (existsErrorInBag($name)): ?>
        <input type="file" name="<?= htmlspecialchars($name); ?>"
            class="border-red-500 w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>" id="<?= htmlspecialchars($id); ?>"
            lang="es" size="2048" accept="image/jpg, image/png, image/gif, image/jpeg">
    <?php else: ?>
        <input type="file" name="<?= htmlspecialchars($name); ?>"
            class="w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>" id="<?= htmlspecialchars($id); ?>"
            lang="es" size="2048" accept="image/jpg, image/png, image/gif, image/jpeg">
    <?php endif; ?>
</div>