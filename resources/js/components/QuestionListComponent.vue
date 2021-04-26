<template>
    <div class="container">

        <el-table
            :data="questions"
            style="width: 100%">
            <el-table-column
                label="問題文"
                prop="QuestionText">
            </el-table-column>
            <el-table-column
                label="答え"
                prop="Answer">
            </el-table-column>
            <!-- <el-table-column
                label="カテゴリー１"
                prop="Category1">
            </el-table-column>
            <el-table-column
                label="カテゴリー2"
                prop="Category2">
            </el-table-column> -->
            <el-table-column
            align="right"
            width="100%">
                <template slot-scope="scope">
                    <el-button
                    size="mini"
                    type="primary"
                    @click="handleView(scope.row)">表示</el-button>
                    <el-button
                    size="mini"
                    type="success"
                    @click="handleEdit(scope.row)">編集</el-button>
                    <el-button
                    size="mini"
                    type="danger"
                    @click="deleteQuestion(scope.row)">削除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <!-- <table class="table table-hover">
            <thead class="thead-light">
            <tr align="center">
                <th scope="col">問題文</th>
                <th scope="col">答え</th>
                <th scope="col">カテゴリー１</th>
                <th scope="col">カテゴリー２</th>
                <th scope="col">カテゴリー３</th>
                <th scope="col">メニュー</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="question in questions" v-bind:key="question.id" align="center">
                    <td>{{ question.QuestionText }}</td>
                    <td>{{ question.Answer }}</td>
                    <td>{{ question.Category1 }}</td>
                    <td>{{ question.Category2 }}</td>
                    <td>{{ question.Category3 }}</td>
                    <td>
                        <router-link v-bind:to="{name: 'question.show', params: {questionId: question.id }}">
                            <button class="btn btn-primary">表示</button>
                        </router-link>
                   
                        <router-link v-bind:to="{name: 'question.edit', params: {questionId: String(question.id) }}">
                            <button class="btn btn-success">編集</button>
                        </router-link>
                  
                        <button class="btn btn-danger" v-on:click="deleteQuestion(question.id)">削除</button>
                    </td>
                </tr>
            </tbody>
        </table> -->
    </div>
</template>

<script>
    import api from "../../api/index";

    export default {
        data: function () {
            return {
                questions: []
            }
        },
        methods: {
            getQuestions() {
                api({
                    method : 'GET',
                    url    : '/api/questions'
                })
                    .then((respData) => {
                        this.questions = respData;
                    })
            },
            deleteQuestion(rowData) {
                api({
                        method : 'delete',
                        url    : '/api/questions/' + rowData.id,
                    })
                   .then((res) => {
                       this.getQuestions();
                   });
            },
            handleEdit(rowData) {
                this.$router.push({name: 'question.edit', params: {questionId: String(rowData.id) }});
            },
            handleView(rowData){
                this.$router.push({name: 'question.show', params: {questionId: rowData.id }});
            }
        },
        created() {
            this.getQuestions();
        }
    }
</script>

<style lang="scss">
    .table{
        min-width:1120px;
    }
</style>