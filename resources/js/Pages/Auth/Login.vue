<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="CatShow"></Head>
    <div class="container-login">
        <form class="login-form"  @submit.prevent="submit">

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
            <div class="form-container">
                <h1>Добро пожаловать на CatShow</h1>
                <hr>
                <div>
                    <InputLabel for="email" value="Email"/>

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full rounded-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div>
                    <InputLabel for="password" value="Password"/>

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full rounded-full"
                        v-model="form.password"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>
                <PrimaryButton class="ml-4 rounded-full registerbtn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Продолжить
                </PrimaryButton>
            </div>

            <div class="form-container block w-full">
                <Link
                    :href="route('register')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <p class="signin py-3 rounded-full">У вас ещё нет аккаунта? <a href="#"> Зарегистрироваться</a></p>
                </Link>
            </div>
        </form>
    </div>

</template>

<style>
.login-form {
    background: rgba(217, 217, 217, 0.8);
    border-radius: 40px;
    padding: 30px;
}
.container-login {
    background-image: url("/images/CatBek.png");
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 100vh;
}

/* Add padding to containers */
.form-container {
    padding: 16px;
    width: 100%;
}

.form-container h1 {
    font-size: 40px;
    font-weight: 600;
}

h1 {
    font-size: 50px;
    font-weight: 700;
    text-align: center;
}


/* Full-width input fields */
.login-form input[type=text], .login-form input[type=email], .login-form input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=email]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
    display: block;
    background-color: #658DCB;
    color: white;
    padding: 10px 20px;
    margin: 0 auto;
    border: none;
    cursor: pointer;
    width: 30%;
    opacity: 0.9;
    border-radius: 30px;

}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
