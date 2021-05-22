<template >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12" v-bind:class="$mq | mq({ phone: 'formContainer_phone', tablet: 'formContainer_tablet', other: 'formContainer_pc' })">
                <form v-on:submit.prevent="submit">

                    <div class="form-group row">
                        <label for="Name" class="col-sm-1 col-form-label">セット名</label>
                        <input type="text" class="col-sm-4 form-control" id="Name" v-model="questionSet.Name">
                    </div>
                    <div class="form-group row">
                        <p class="error">
                            {{ Validation.setName }}
                        </p>
                    </div>
                    <div class="form-group row">
                        <label for="QuestionsNum" class="col-sm-1 col-form-label">問題数</label>
                        <input :value="getQuestionsNum()" disabled type="text" class="col-sm-1 form-control" id="QuestionsNum" >
                    </div>

                    <el-table
                        ref="questionTable"
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
                    
                    <button type="submit" class="btn btn-primary">編集完了</button>
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
        props: {
            questionSetId: String
        },
        data: function () {
            return {
                questions: [],
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
                    .then((res) => {
                         if(res.errorCode !== 20000){
                            alert(res.errorDetail);
                        }else{
                            this.questions = res.value;
                            this.getQuestionSet();
                        }       
                    })
                    .catch((res) => {
                        alert(res);
                    });
            },
            getQuestionSet() {
                api({
                    method : 'GET',
                    url    : '/api/questionSet/' + this.questionSetId
                })
                    .then((res) => {
                        if(res.errorCode !== 20000){
                            alert(res.errorDetail);
                        }else{
                            this.questionSet = res.value;
                            this.setDefaultChecked();
                        }          
                    })
                    .catch((res) => {
                        alert(res);
                    });
            },
            existRowInQuestions(rowId) {
                //なぜか最初にundefinedになるから応急処置
                if(this.questionSet.Questions === undefined) return false;

                for (let i = 0; i < this.questionSet.Questions.length; i++) {
                    if(this.questionSet.Questions[i].id === rowId) return true;
                }
                return false;
            },
            setDefaultChecked() {

                this.questions.forEach(question => {
                    this.$refs.questionTable.toggleRowSelection(question,this.existRowInQuestions(question.id))
                });
                
            },
            shapeQSetData() {

                this.questionSet = {
                    Name:this.questionSet.Name,
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
                   this.update();
                }
            },
            validate() {
                let correctFlag = true;

                if(this.questionSet.Name === ""){
                    correctFlag = false;
                    this.Validation.setName = "セット名を入力してください";
                }else{
                    this.Validation.setName = "";
                }
                
                return correctFlag;
            },
            update() {
                this.shapeQSetData();

                api({
                        method : 'put',
                        url    : '/api/questionSets/' + this.questionSetId,
                        data : this.questionSet
                    })
                    .then((res) => {
                        if(res.errorCode !== 20000){
                            alert(res.errorDetail);
                            return;
                        }

                        this.shapeGroupingData(res.value.id);
                        api({
                                method : 'delete',
                                url    : '/api/grouping/' + this.questionSetId
                            })
                            .then((res) => {
                                api({
                                    method : 'put',
                                    url    : '/api/grouping',
                                    data : this.groupingArray
                                })
                                .then((res) => {
                                    if(res.errorCode !== 20000){
                                        alert(res.errorDetail);
                                    }else{
                                        this.$router.push({name: 'questionSets.list'});
                                    }      
                                })
                                .catch((res) => {
                                    alert(res);
                                });
                            });       
                    })
                    .catch((res) => {
                        alert(res);
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