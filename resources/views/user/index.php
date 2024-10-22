<div class="space-y-4">
    <? require_once __DIR__ . '/../components/messages.php'; ?>
    <div class="container mx-auto mb-5">
        <div class="flex flex-col items-center p-6">
            <div class="w-full max-w-lg mx-auto border border-gray-300">
                <div class="py-4 text-center border-b border-gray-300">
                    <h3 class="text-2xl font-semibold uppercase"><? __('nav.login') ?></h3>
                </div>
                <form action="<?= BASE_URL ?>/user/login" method="POST" id="formLogin" class="p-4">
                    <div class="space-y-4">
                        <?php renderInput('email', 'email', 'user.email'); ?>
                        <?php renderInput('password', 'password', 'user.password'); ?>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            <? __('nav.login') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>