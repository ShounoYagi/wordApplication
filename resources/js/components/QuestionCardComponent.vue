<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">

                <flipper
                    class="Card"
                    :width="$mq | mq({ phone: '90%', tablet: '80%', other: '600px' })"
                    :height="$mq | mq({ phone: '100px', tablet: '150px', other: '200px' })"
                    :flipped="flipped"
                    @click="onClick"
                >
                    <div ref="front" class="Card__face" slot="front">
                        {{activeQuestionText}}
                    </div>

                    <div ref="back" class="Card__face" slot="back">
                        {{activeAnswerText}}
                    </div>

                </flipper>

            </div>
        </div>
    </div>
</template>

<script>

    import Flipper from 'vue-flipper';
    import 'vue-flipper/dist/vue-flipper.css';
    import ElementUI from 'element-ui'
    import locale from 'element-ui/lib/locale/lang/ja'
    import 'element-ui/lib/theme-chalk/index.css'
    import 'element-ui/lib/theme-chalk/display.css'

    export default {
        data () {
            return {
                
            };
        },
        props: {
            'activeAnswerText': {
                type: String,
                default: "",
                required:true
            },
            'activeQuestionText': {
                type: String,
                default: "",
                required:true
            },
            'flipped': {
                type: Boolean,
                default: false,
                required:true
            }
        },
        methods: {
            onClick () {
                this.$emit("onClickCard");
            }
        },
        components: {
            Flipper
        }
        
    }
</script>

<style module>
    .cardStyle{
        cursor:pointer;
    }
</style>

<style src="vue-flipper/dist/vue-flipper.css" />

<style lang="scss">
.Card {
    margin: 5rem auto 2rem auto;
  &__face,
  &__pattern {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    box-shadow: 0 3px 15px rgba(#000, 0.45);
    cursor: pointer;
  }

  &__pattern {
    background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNjAiIGhlaWdodD0iMzAiPgo8ZGVmcz4KPHJlY3QgaWQ9InIiIHdpZHRoPSIzMCIgaGVpZ2h0PSIxNSIgZmlsbD0iI2JiMDg1ZiIgc3Ryb2tlLXdpZHRoPSIyLjUiIHN0cm9rZT0iIzdhMDU0ZCI+PC9yZWN0Pgo8ZyBpZD0icCI+Cjx1c2UgeGxpbms6aHJlZj0iI3IiPjwvdXNlPgo8dXNlIHk9IjE1IiB4bGluazpocmVmPSIjciI+PC91c2U+Cjx1c2UgeT0iMzAiIHhsaW5rOmhyZWY9IiNyIj48L3VzZT4KPHVzZSB5PSI0NSIgeGxpbms6aHJlZj0iI3IiPjwvdXNlPgo8L2c+CjwvZGVmcz4KPHVzZSB4bGluazpocmVmPSIjcCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAtMjUpIHNrZXdZKDQwKSI+PC91c2U+Cjx1c2UgeGxpbms6aHJlZj0iI3AiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMwIDApIHNrZXdZKC00MCkiPjwvdXNlPgo8L3N2Zz4=");
  }

  &__face {
    display: flex;
    text-align: center;
    font-size: 4vw;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    padding: 15px;
  }

  &__value {
    display: block;
    font-size: 18pt;

    &--top {
      align-self: flex-start;
    }

    &--bottom {
      align-self: flex-end;
    }
  }
}
</style>

