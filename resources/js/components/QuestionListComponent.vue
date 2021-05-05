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
                    <el-row>
                        <el-button
                        size="mini"
                        type="primary"
                        @click="handleView(scope.row)">表示</el-button>
                    </el-row>
                    <el-row>
                        <el-button
                        size="mini"
                        type="success"
                        @click="handleEdit(scope.row)">編集</el-button>
                    </el-row>
                    <el-row>
                        <el-button
                        size="mini"
                        type="danger"
                        @click="deleteQuestion(scope.row)">削除</el-button>
                    </el-row>
                </template>
            </el-table-column>
        </el-table>

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
                    .then((res) => {
                         if(res.errorCode !== 20000){
                            alert(res.errorDetail);
                        }else{
                            this.questions = res.value;
                        }
                    })
                    .catch((res) => {
                        alert(res);
                    });
            },
            deleteQuestion(rowData) {
                api({
                        method : 'delete',
                        url    : '/api/questions/' + rowData.id,
                    })
                   .then((res) => {
                        if(res.errorCode !== 20000){
                            alert(res.errorDetail);
                        }else{
                            this.getQuestions();
                        }
                   })
                   .catch((res) => {
                        alert(res);
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
    .el-row{
        text-align: center;
    }
</style>