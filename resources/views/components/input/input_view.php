<div>
    <?php if ($label): ?>
        <?php if (existsKeyInBag($name, 'errors')): ?>
            <label for="<?= htmlspecialchars($id); ?>" class="block font-medium text-red-600">
                <?= __($label); ?>
            </label>
        <?php else: ?>
            <label for="<?= htmlspecialchars($id); ?>" class="block font-medium">
                <?= __($label); ?>
            </label>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (existsKeyInBag($name, 'errors')): ?>
        <input type="<?= htmlspecialchars($type); ?>"
            name="<?= htmlspecialchars($name); ?>"
            id="<?= htmlspecialchars($id); ?>"
            class="border-red-500 w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>">
        <?php foreach ($_SESSION['errors'][$name] as $error): ?>
            <p class="text-red-600"><?= htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <input type="<?= htmlspecialchars($type); ?>"
            name="<?= htmlspecialchars($name); ?>"
            id="<?= htmlspecialchars($id); ?>"
            class=" border-black w-full p-2 border-2 rounded-md shadow-sm<?= htmlspecialchars($class); ?>">
    <?php endif; ?>
</div>