<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">

                <h2 v-bind:class="$mq | mq({ phone: 'setName_phone', tablet: 'setName_tablet', other: 'setName_pc' })">{{questionSet.Name}}</h2>

                <QuestionCardComponent :flipped="flipped" :activeAnswerText="activeAnswerText" :activeQuestionText="activeQuestionText" @onClickCard="onClickCard"
                    v-if = "!reversedCard"/>
                <QuestionCardComponent :flipped="flipped" :activeAnswerText="activeQuestionText" :activeQuestionText="activeAnswerText" @onClickCard="onClickCard"
                    v-if = "reversedCard"/>

                <div class="ButtonContainer" v-bind:class="$mq | mq({ phone: 'width_80percent', tablet: 'width_70percent', other: 'width_600px' })">
                    <el-button class="ButtonContainer__button" :style="{visibility: activeQuestionIndex != 0 ? 'visible' : 'hidden'}" 
                        v-on:click="handleReturnClick">前の問題へ</el-button>
                    <el-button class="ButtonContainer__button" v-if = "activeQuestionIndex != questions.length -1" 
                        v-on:click="handleNextClick" type="success">次の問題へ</el-button>
                    <el-button class="ButtonContainer__button" v-else type="success" v-on:click="handleEndClick">終了する</el-button>
                </div>

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
    import QuestionCardComponent from './QuestionCardComponent'

    export default {
        props: {
            questionSetId: String
        },
        components: { QuestionCardComponent },
        data: function () {
            return {
                questionSet: {},
                questions: [],
                activeQuestionIndex: 0,
                flipped: false,
                reversedCard: false
            }
        },
        computed: {
            activeQuestionText: function() {

                if( this.questions[this.activeQuestionIndex] === undefined ) return "";
                return this.questions[this.activeQuestionIndex].QuestionText;

            },
            activeAnswerText: function() {

                if( this.questions[this.activeQuestionIndex] === undefined ) return "";
                return this.questions[this.activeQuestionIndex].Answer;

            }
        },
        methods: {
            getQuestionSet() {
                api({
                    method : 'GET',
                    url    : '/api/questionSet/' + this.questionSetId
                })
                    .then((respData) => {
                        this.questionSet = respData;
                        this.questions = respData.Questions;
                    })
            }, 
            handleNextClick() {
                this.activeQuestionIndex++;
                if(this.flipped) this.reversedCard = true;
                else this.reversedCard = false;
            },
            handleReturnClick() {
                this.activeQuestionIndex--;
                if(this.flipped) this.reversedCard = true;
                else this.reversedCard = false;
            },
            onClickCard () {
                this.flipped = !this.flipped;
            },
            handleEndClick(){
                this.$router.push({ name: 'questionSets.list'})
            }
        },
        created() {
            this.getQuestionSet();
        }
        
    }
</script>

<style lang="scss">
.setName_phone{
    font-size: 1.6rem;
}
.setName_tablet{
    font-size: 2rem;
}
.setName_pc{
    font-size: 2.8rem;
}
.ButtonContainer {

    display: flex;
    justify-content: space-between;
    margin: 0 auto;
}
.width_600px{
    width:600px;
    button{
        font-size: 1.4rem;
        width:25%;
    }
}
.width_70percent{
    width:70%;
    button{
        font-size: 1.2rem;
        width:45%;
    }
}
.width_80percent{
    width:80%;
    button{
        font-size: 3.5vw;
        width:50%;
        text-align: center;
    }
}

</style>
