<div class="relative">
    <a class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md cursor-pointer dropdown-toggle hover:bg-indigo-500 hover:text-white">
        <?php echo __('nav.categories') ?>
    </a>
    <div class="absolute z-10 hidden w-48 mt-1 bg-white rounded-lg shadow-lg dropdown-menu">
        <?php foreach (getCategories() as $id => $value): ?>
            <a href="<?= BASE_URL ?>/album/category/<?php echo ($value) ?>"
                class="block px-4 py-2 text-gray-700 capitalize rounded-lg hover:bg-gray-200 hover:text-black hover:font-bold">
                <?php echo ($value) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>