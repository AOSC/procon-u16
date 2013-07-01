#!/bin/bash

curl -XPOST \
  --form name=島口知也 \
  --form school_name=旭川市東陽中学校 \
  --form grade=2 \
  --form category_id=2 \
  --form lecture_id=3 \
  --form lecture_pref_day_one=1 \
  --form lecture_pref_day_two=2 \
  --form lecture_pref_day_three=2 \
  --form lecture_pref_day_four=3 \
  --form comment=特にコメントありましぇん \
  --form lecture_comment=目が悪いので、前の方で講義受けたいなぁ \
  --form category_comment=作品は未定なんですまだ \
  http://localhost:3000/public/api/entry.php
