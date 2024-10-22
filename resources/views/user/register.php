<div class="container mx-auto mb-5">
    <div class="flex flex-col items-center">
        <div class="w-full p-6 mx-auto bg-white border shadow-md lg:w-1/2">
            <div class="py-4 text-center border-b">
                <h3 class="text-3xl font-semibold"><? __('user.form.title') ?></h3>
            </div>
            <form action="<?= BASE_URL ?>/user/register" method="POST" enctype="multipart/form-data" id="formRegister" class="w-full mt-4 space-y-4">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <?php renderInput('email', 'email', 'user.email'); ?>
                    <?php renderInput('userName', 'text', 'user.userName'); ?>
                    <?php renderInput('password', 'password', 'user.password'); ?>
                    <?php renderInput('samePassword', 'password', 'user.samePassword'); ?>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <?php renderInput('name', 'text', 'user.name'); ?>
                    <?php renderInput('lastName', 'text', 'user.lastName'); ?>
                    <?php renderInput('address', 'text', 'user.address'); ?>
                </div>

                <div class="flex items-center justify-center gap-2">
                    <?php renderInputImage('image', 'user.image'); ?>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700"><? __('user.form.button') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>