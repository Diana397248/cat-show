<script setup>
import {Head, Link} from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import VideoCard from '@/Components/VideoCard.vue';

defineProps({
    videos: Array
});
</script>

<template>
    <Head title="CatShow"/>
    <div class="container-group">
        <div class="text">
            <h1>Зарегестрируйтесь, чтобы смотреть больше смешных видео с котиками</h1>
        </div>
        <div class="form-block">
            <form>
                <div class="form-container">
                    <h1>Добро пожаловать на CatShow</h1>
                    <p>Пожалуйста, заполните эту форму, чтобы создать учетную запись</p>
                    <hr>

                    <label for="name"><b>Имя</b></label>
                    <input type="text" placeholder="Enter Name" name="name" required>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Пароль</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <label for="psw-repeat"><b>Повтор Пароля</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                    <hr>

                    <button type="submit" class="registerbtn">Продолжить</button>
                </div>

                <p class="sign_text">У вас уже есть аккаунт? <a href="#"> Войти</a></p>
            </form>
        </div>

    </div>
</template>

<style>
* {
    box-sizing: border-box
}
.form-block{
    width:40%;
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

p {
    text-align: center;
}


/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
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
    background-color: #658DCB;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
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
