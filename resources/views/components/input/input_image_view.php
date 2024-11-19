<div class="flex flex-col md:flex-row md:items-center md:justify-between">

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
            <input type="file" name="<?= htmlspecialchars($name); ?>"
                class="border-red-500 block w-full text-sm text-slate-500
        file:mr-4 file:py-2 file:px-4 file:rounded-md
        file:border-0 file:text-sm file:font-semibold
        file:bg-pink-50 file:text-pink-700
        hover:file:bg-pink-100 border-2<?= htmlspecialchars($class); ?>" id="<?= htmlspecialchars($id); ?>"
                lang="es" size="2048" accept="image/jpg, image/png, image/gif, image/jpeg">
            <?php foreach ($_SESSION['errors'][$name] as $error): ?>
                <p class="text-red-600"><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <input type="file" name="<?= htmlspecialchars($name); ?>"
                class="block w-full text-sm text-slate-500
        file:mr-4 file:py-2 file:px-4 file:rounded-md
        file:border-0 file:text-sm file:font-semibold
        file:bg-pink-50 file:text-pink-700
        hover:file:bg-pink-100<?= htmlspecialchars($class); ?>" id="<?= htmlspecialchars($id); ?>"
                lang="es" size="2048" accept="image/jpg, image/png, image/gif, image/jpeg">
        <?php endif; ?>
    </div>
</div>