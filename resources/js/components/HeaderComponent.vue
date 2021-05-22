<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">単語帳アプリケーション</span>
                
                    <mq-layout :mq="[ 'phone', 'tablet' ]">
                        <div class="menu">
                            <slide right width="170">
                                <a id="home" href="/questions">
                                <span class="link">問題一覧</span>
                                </a>
                                <a id="about" href="/questions/create">
                                <span class="link">新規問題登録</span>
                                </a>
                                <a id="contact" href="/questionSets">
                                <span class="link">問題セット一覧</span>
                                </a>
                                <a id="contact" href="/questionSets/create">
                                <span class="link">問題セット作成</span>
                                </a>
                            </slide>
                        </div>
                    </mq-layout>

                    <mq-layout mq="other">
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
                    </mq-layout>

                
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
    .link{
        width:95%;
    }
    .buttonContainer{
        min-width:550px;
    }
    .menu{
        .bm-burger-bars{
            background-color:white
        }
        .bm-burger-button{
            top:13px;
            left:95%!important
        }
        .bm-cross-button{
            right:120px!important
        }
        .bm-item-list{
            font-size:16px;
            min-width:150px;
            margin-left:0
        }
    }
</style>