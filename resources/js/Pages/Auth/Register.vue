<script setup>
import {Head, useForm, Link} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="CatShow"/>

    <div class="container-group">

        <div class="text">
            <h1 class="title">Зарегестрируйтесь, чтобы смотреть больше смешных видео с котиками</h1>
        </div>
        <div class="form-block">
            <form class="register-form" @submit.prevent="submit">
                <div class="form-container">
                    <h1>Добро пожаловать на CatShow</h1>
                    <p>Пожалуйста, заполните эту форму, чтобы создать учетную запись</p>
                    <hr>

                    <div>
                        <InputLabel for="name" value="Имя"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block rounded-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>

                    <div>
                        <InputLabel for="email" value="Email"/>

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block rounded-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Пароль"/>

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block rounded-full"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Повтор пароля"/>

                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block rounded-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                    </div>
                    <hr>
                    <PrimaryButton class="ml-4 rounded-full registerbtn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Продолжить
                    </PrimaryButton>
                </div>
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <p class="sign_text rounded-full py-3">У вас уже есть аккаунт? <a href="#"> Войти</a></p>
                </Link>


            </form>
        </div>
    </div>

</template>

<style>
* {
    box-sizing: border-box
}
.register-form {
    background: rgba(217, 217, 217, 0.8);
    border-radius: 40px;
    padding: 30px;
}
.container-group {
    background-image: url("/images/CatBek.png");
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 100vh;
}

.form-block {
    width: 40%;
}

.text {
    width: 545px;
    height: 244px;
    left: 200px;
    top: 450px;
    font-style: normal;
    font-weight: 700;
    font-size: 50px;
    line-height: 61px;
}


.container-group {
    /*background-image: url("/images/CatBek.png");*/

    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: 100vh;
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
.title{
    color: white;
}

p {
    text-align: center;
}


/* Full-width input fields */
.register-form input[type=text], .register-form input[type=email], .register-form input[type=password] {
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
    text-align: center;

}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.sign_text {
    margin-top: 20px;
    background-color: #f1f1f1;
    text-align: center;
}
</style>
