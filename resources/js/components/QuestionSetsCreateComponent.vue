<template>
    <div class="container">
        <div class="row justify-content-center">
            <div  v-bind:class="$mq | mq({ phone: 'formContainer_phone', tablet: 'formContainer_tablet', other: 'formContainer_pc' })" >
                <form v-on:submit.prevent="submit">

                    <div class="form-group column">
                        <label for="Name" class="col-sm-4 col-form-label">セット名</label>
                        <input type="text" class="col-sm-4 form-control" id="Name" v-model="setName">
                        <p class="error">
                            {{ Validation.setName }}
                        </p>
                    </div>
                    <div class="form-group column">
                        <label for="QuestionsNum" class="col-sm-4 col-form-label">問題数</label>
                        <input :value="getQuestionsNum()" disabled type="text" class="col-sm-1 form-control" id="QuestionsNum" >
                    </div>

                    <el-table
                        ref="multipleTable"
                        :data="questions"
                        style="width: 100%"
                        @selection-change="handleSelectionChange">
                        <el-table-column
                            type="selection"
                            width="55">
                        </el-table-column>
                        <el-table-column
                            property="QuestionText"
                            label="問題文"
                            width="240">
                        </el-table-column>
                        <el-table-column
                            property="Answer"
                            label="答え"
                            width="240">
                        </el-table-column>
                        <el-table-column
                            property="Category1"
                            label="大分類"
                            width="120">
                        </el-table-column>
                        <el-table-column
                            property="Category2"
                            label="中分類"
                            width="120">
                        </el-table-column>
                        <el-table-column
                            property="Category3"
                            label="小分類"
                            width="120">
                        </el-table-column>
                    </el-table>
                    
                    <button type="submit" class="btn btn-primary">登録</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import api from "../../api/index";

    import ElementUI from 'element-ui'
    import locale from 'element-ui/lib/locale/lang/ja'
    import 'element-ui/lib/theme-chalk/index.css'
    import 'element-ui/lib/theme-chalk/display.css'

    export default {
        data: function () {
            return {
                questions: [],
                setName:"",
                questionSet: {},
                groupingArray:[],
                multipleSelection: [],
                Validation:{
                    setName: ""
                }
            }
       },
       methods: {
            getQuestions() {
                api({
                    method : 'GET',
                    url    : '/api/questions'
                })
                    .then((respData) => {
                        if(respData.success){
                            this.questions = respData.response;
                        }else{
                            alert(respData.message);
                        }
                    })
            },
            shapeQSetData() {
                this.questionSet = {
                    Name:this.setName,
                    QuestionsNum:this.multipleSelection.length
                }
            },
            shapeGroupingData(setsIdArgs) {
                for (const selectData of this.multipleSelection) {
                    this.groupingArray.push({
                        QuestionId :selectData.id,
                        SetsId : setsIdArgs
                    })
                }
            },
            submit() {
                if(this.validate()){
                   this.register();
                }
            },
            validate() {
                let correctFlag = true;

                if(this.setName === ""){
                    correctFlag = false;
                    this.Validation.setName = "セット名を入力してください";
                }else{
                    this.Validation.setName = "";
                }
                
                return correctFlag;
            },
            register() {
                this.shapeQSetData();
                api({
                        method : 'post',
                        url    : '/api/questionSets',
                        data : this.questionSet
                    })
                    .then((res) => {
                        this.shapeGroupingData(res.id);
                        api({
                                method : 'post',
                                url    : '/api/grouping',
                                data : this.groupingArray
                            })
                            .then((res) => {
                                this.$router.push({name: 'questionSets.list'});
                            });
                    });
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            getQuestionsNum() {
                return this.multipleSelection.length;
            }
       },
       created() {
            this.getQuestions();
        }
    }
</script>

<style scoped>
    .formContainer_pc{
        min-width:1000px;
    }
    .formContainer_tablet{
        max-width:900px;
        width:80%
    }
    .formContainer_phone{
        max-width:300px;
        width:80%
    }
    .error {
        color:red;
    }
</style>