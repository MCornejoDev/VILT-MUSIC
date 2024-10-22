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
        <input type="<?= htmlspecialchars($type); ?>"
            name="<?= htmlspecialchars($name); ?>"
            id="<?= htmlspecialchars($id); ?>"
            class="border-red-500 w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>">
    <?php else: ?>
        <input type="<?= htmlspecialchars($type); ?>"
            name="<?= htmlspecialchars($name); ?>"
            id="<?= htmlspecialchars($id); ?>"
            class=" border-black w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>">
    <?php endif; ?>
</div>