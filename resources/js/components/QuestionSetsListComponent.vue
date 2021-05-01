<template>
    <div class="container  setsContainer">

            <el-table
                :data="questionSets"
                style="width: 100%">
                <el-table-column
                    label="セット名"
                    prop="Name">
                </el-table-column>
                <el-table-column
                    label="問題数"
                    width="70%"
                    align="center"
                    prop="QuestionsNum">
                </el-table-column>
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
                            @click="deleteQuestionSets(scope.row)">削除</el-button>
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
            deleteQuestionSets(rowData) {
                api({
                    method : 'delete',
                    url    : '/api/questionSets/' + rowData.id,
                })
                   .then((res) => {
                       this.getQuestionSets();
                   });
            },
            handleEdit(rowData) {
                this.$router.push({name: 'questionSets.edit', params: {questionSetId: String(rowData.id) }});
            },
            handleView(rowData){
                this.$router.push({name: 'examination', params: {questionSetId: String(rowData.id)}});
            }
        },
        created() {
            this.getQuestionSets();
        }
    }
</script>

<style lang="scss">
    .setsContainer{
        min-width: 300px;
    }
    .table{
        min-width: 300px;
    }
    .el-row{
        text-align: center;
    }
</style>