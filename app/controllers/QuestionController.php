<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/18/14
     * Time: 10:48 AM
     */
    class QuestionController
        extends BaseController
    {
        public function getIndex()
        {
            $questionlist = array();
            $questions = Question::orderBy("send_time", "desc")
                                 ->get();
            foreach ($questions as $index => $question)
            {
                $questinfo = array("question" => $question->toArray(),
                                   "answer" => $question->answer->toArray());
                $questionlist[$index] = $questinfo;
            }

            print_r($questionlist);

        }

        public function getMyquestion()
        {
            $id = Input::get("id");
            $questionlist = array();
            $questions = Question::where("woner_id", "=", $id)
                                 ->orderBy("send_time", "desc")
                                 ->get();
            foreach ($questions as $index => $question)
            {
                $questinfo = array("question" => $question->toArray(),
                                   "answer" => $question->answer->toArray());
                $questionlist[$index] = $questinfo;
            }

            print_r($questionlist);
        }

        public function postAsk()
        {
            $id = Input::get("id");
            $content = trim((string)Input::get("content"));
            $question = new Question();
            $question->owner_id = $id;
            $question->content = $content;
            $question->send_time = date("Y-m-d H:i:s");
            try
            {
                $question->save();
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function postReply()
        {
            $q_id = Input::get("qustion_id");
            $id = Input::get("id");
            $content = trim((string)Input::get("content"));
            $question = Question::find($q_id);
            $answer = new Answer();
            DB::begintransaction();
            try
            {
                $answer->owner_id = $id;
                $answer->content = $content;
                $answer->answer_time = date("Y-m-d H:i:s");
                if (!$answer->save())
                {
                    throw new PDOException("answer");
                }
                $question->answer_id = $answer->a_id;
                $question->solved = 1;
                $question->solved_time = $answer->answer_time;
                if (!$question->save())
                {
                    throw new PDOException("question");
                }

                DB::commit();
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                DB::rollback();
            }

        }
    }