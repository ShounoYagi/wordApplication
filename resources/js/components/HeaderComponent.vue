<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">単語帳アプリケーション</span>
                <div class="buttonContainer">
                    <router-link v-bind:to="{name: 'question.list'}">
                        <button class="btn btn-success">問題一覧</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'question.create'}">
                        <button class="btn btn-success">新規問題登録</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'questionSets.list'}">
                        <button class="btn btn-success">問題セット一覧</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'questionSets.create'}">
                        <button class="btn btn-success">問題セット作成</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {}
</script>

<style lang="scss">
    .btn{
        min-width:100px;
    }
    .buttonContainer{
        min-width:550px;
    }
</style>