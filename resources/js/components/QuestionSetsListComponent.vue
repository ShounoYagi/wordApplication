<template>
    <div class="container  setsContainer">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr align="center">
                <th scope="col">セット名</th>
                <th scope="col">問題数</th>
                <th scope="col">メニュー</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="questionSet in questionSets" v-bind:key="questionSet.id" align="center">

                    <td>{{ questionSet.Name }}</td>

                    <td>{{ questionSet.QuestionsNum }}</td>

                    <td>
                        <router-link v-bind:to="{name: 'examination', params: {questionSetId: String(questionSet.id) }}">
                            <button class="btn btn-primary">問題を解く</button>
                        </router-link>
               
                        <router-link v-bind:to="{name: 'questionSets.edit', params: {questionSetId: String(questionSet.id) }}">
                            <button class="btn btn-success">編集</button>
                        </router-link>
                   
                        <button class="btn btn-danger" v-on:click="deleteQuestionSets(questionSet.id)">削除</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import api from "../../api/index";

    export default {
        data: function () {
            return {
                questionSets: []
            }
        },
        methods: {
            getQuestionSets() {
                api({
                    method : 'GET',
                    url    : '/api/questionSets'
                })
                    .then((respData) => {
                        this.questionSets = respData;
                    })
            },
            deleteQuestionSets(id) {
                api({
                    method : 'delete',
                    url    : '/api/questionSets/' + id,
                })
                   .then((res) => {
                       this.getQuestionSets();
                   });
            }
        },
        created() {
            this.getQuestionSets();
        }
    }
</script>

<style lang="scss">
    .setsContainer{
        min-width:1120px;
    }
</style>