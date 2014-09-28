
002
 
003
Licensed to the Apache Software Foundation (ASF) under one or more
004
contributor license agreements.  See the NOTICE file distributed with
005
this work for additional information regarding copyright ownership.
006
The ASF licenses this file to You under the Apache License, Version 2.0
007
(the "License"); you may not use this file except in compliance with
008
the License.  You may obtain a copy of the License at
009
 
010
http://www.apache.org/licenses/LICENSE-2.0
011
 
012
Unless required by applicable law or agreed to in writing, software
013
distributed under the License is distributed on an "AS IS" BASIS,
014
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
015
See the License for the specific language governing permissions and
016
limitations under the License.
017
 
018
*/
019
 
020
#menu-wrapper
021
{
022
  position: fixed;
023
  top: 120px;
024
  width: 150px;
025
}
026
 
027
.scroll #menu-wrapper
028
{
029
  position: absolute;
030
  top: 90px;
031
}
032
 
033
.has-environment #menu-wrapper
034
{
035
  top: 160px;
036
}
037
 
038
#menu-wrapper a
039
{
040
  display: block;
041
  padding: 4px 2px;
042
  overflow: hidden;
043
  text-overflow: ellipsis;
044
}
045
 
046
#core-selector
047
{
048
  margin-top: 20px;
049
  padding-right: 10px;
050
}
051
 
052
#core-selector a
053
{
054
  padding: 0;
055
  padding-left: 8px;
056
}
057
 
058
#core-selector select
059
{
060
  width: 100%;
061
}
062
 
063
#core-selector #has-no-cores
064
{
065
  display: none;
066
}
067
 
068
#core-selector #has-no-cores a
069
{
070
  background-image: url( ../../img/ico/database--plus.png );
071
}
072
 
073
#core-selector #has-no-cores span
074
{
075
  color: #c0c0c0;
076
  display: block;
077
}
078
 
079
#menu-wrapper .active p
080
{
081
  background-color: #fafafa;
082
  border-color: #c0c0c0;
083
}
084
 
085
#menu-wrapper p a,
086
#menu a
087
{
088
  background-position: 5px 50%;
089
  padding-left: 26px;
090
  padding-top: 5px;
091
  padding-bottom: 5px;
092
}
093
 
094
#menu-wrapper p a:hover
095
{
096
  background-color: #f0f0f0;
097
}
098
 
099
#menu-wrapper .active p a
100
{
101
  background-color: #c0c0c0;
102
  font-weight: bold;
103
}
104
 
105
#menu p.loader
106
{
107
  background-position: 5px 50%;
108
  color: #c0c0c0;
109
  margin-top: 5px;
110
  padding-left: 26px;
111
}
112
 
113
#menu p a small
114
{
115
  color: #b5b5b5;
116
  font-weight: normal;
117
}
118
 
119
#menu p a small span.txt
120
{
121
  display: none;
122
}
123
 
124
#menu p a small:hover span.txt
125
{
126
  display: inline;
127
}
128
 
129
#menu .busy
130
{
131
  border-right-color: #f6f5d9;
132
}
133
 
134
#menu .busy p a
135
{
136
  background-color: #f6f5d9;
137
  background-image: url( ../../img/ico/status-away.png );
138
}
139
 
140
#menu .offline
141
{
142
  border-right-color: #eccfcf;
143
}
144
 
145
#menu .offline p a
146
{
147
  background-color: #eccfcf;
148
  background-image: url( ../../img/ico/status-busy.png );
149
}
150
 
151
#menu .online
152
{
153
  border-right-color: #cfecd3;
154
}
155
 
156
#menu .online p a
157
{
158
  background-color: #cfecd3;
159
  background-image: url( ../../img/ico/status.png );
160
}
161
 
162
#menu .ping small
163
{
164
  color: #000
165
}
166
 
167
#menu li
168
{
169
  border-bottom: 1px solid #f0f0f0;
170
}
171
 
172
#menu li:last-child
173
{
174
  border-bottom: 0;
175
}
176
 
177
#menu li.optional
178
{
179
  display: none;
180
}
181
 
182
#core-menu p
183
{
184
  border-top: 1px solid #f0f0f0;
185
}
186
 
187
#core-menu li:first-child p
188
{
189
  border-top: 0;
190
}
191
 
192
#core-menu p a
193
{
194
  background-image: url( ../../img/ico/status-offline.png );
195
}
196
 
197
#core-menu .active p a
198
{
199
  background-image: url( ../../img/ico/box.png );
200
}
201
 
202
#core-menu ul,
203
#menu ul
204
{
205
  display: none;
206
  padding-top: 5px;
207
  padding-bottom: 10px;
208
}
209
 
210
#core-menu .active ul,
211
#menu .active ul
212
{
213
  display: block;
214
}
215
 
216
#menu ul li
217
{
218
  border-bottom: 0;
219
}
220
 
221
#core-menu ul li a,
222
#menu ul li a
223
{
224
  background-position: 7px 50%;
225
  border-bottom: 1px solid #f0f0f0;
226
  color: #bbb;
227
  margin-left: 15px;
228
  padding-left: 26px;
229
}
230
 
231
#core-menu ul li:last-child a,
232
#menu ul li:last-child a
233
{
234
  border-bottom: 0;
235
}
236
 
237
#core-menu ul li a:hover,
238
#menu ul li a:hover
239
{
240
  background-color: #f0f0f0;
241
  color: #333;
242
}
243
 
244
#core-menu ul li.active a,
245
#menu ul li.active a
246
{
247
  background-color: #d0d0d0;
248
  border-color: #d0d0d0;
249
  color: #333;
250
}
251
 
252
#menu #index.global p a { background-image: url( ../../img/ico/dashboard.png ); }
253
 
254
#menu #logging.global p a { background-image: url( ../../img/ico/inbox-document-text.png ); }
255
#menu #logging.global .level a { background-image: url( ../../img/ico/gear.png ); }
256
 
257
#menu #java-properties.global p a { background-image: url( ../../img/ico/jar.png ); }
258
 
259
#menu #threads.global p a { background-image: url( ../../img/ico/ui-accordion.png ); }
260
 
261
#menu #cores.global p a { background-image: url( ../../img/ico/databases.png ); }
262
 
263
#menu #cloud.global p a { background-image: url( ../../img/ico/network-cloud.png ); }
264
#menu #cloud.global .tree a { background-image: url( ../../img/ico/folder-tree.png ); }
265
#menu #cloud.global .graph a { background-image: url( ../../img/ico/molecule.png ); }
266
#menu #cloud.global .rgraph a { background-image: url( ../../img/ico/asterisk.png ); }
267
#menu #cloud.global .dump a { background-image: url( ../../img/ico/download-cloud.png ); }
268
 
269
#core-menu .ping.error a
270
{
271
   
272
  background-color: #ffcccc;
273
  background-image: url( ../../img/ico/system-monitor--exclamation.png );
274
  border-color: #ffcccc;
275
  cursor: help;
276
}
277
 
278
#core-menu .overview a { background-image: url( ../../img/ico/home.png ); }
279
#core-menu .query a { background-image: url( ../../img/ico/magnifier.png ); }
280
#core-menu .analysis a { background-image: url( ../../img/ico/funnel.png ); }
281
#core-menu .documents a { background-image: url( ../../img/ico/documents-stack.png ); }
282
#core-menu .files a { background-image: url( ../../img/ico/folder.png ); }
283
#core-menu .schema-browser a { background-image: url( ../../img/ico/book-open-text.png ); }
284
#core-menu .replication a { background-image: url( ../../img/ico/node.png ); }
285
#core-menu .distribution a { background-image: url( ../../img/ico/node-select.png ); }
286
#core-menu .ping a { background-image: url( ../../img/ico/system-monitor.png ); }
287
#core-menu .logging a { background-image: url( ../../img/ico/inbox-document-text.png ); }
288
#core-menu .plugins a { background-image: url( ../../img/ico/block.png ); }
289
#core-menu .dataimport a { background-image: url( ../../img/ico/document-import.png ); }
290
 
291
 
292
#content #navigation
293
{
294
  border-right: 1px solid #e0e0e0;
295
}
296
 
297
#content #navigation a
298
{
299
  display: block;
300
  padding: 4px 2px;
301
}
302
 
303
#content #navigation .current
304
{
305
  border-color: #e0e0e0;
306
}
307
 
308
#content #navigation a
309
{
310
  background-position: 5px 50%;
311
  padding-left: 26px;
312
  padding-top: 5px;
313
  padding-bottom: 5px;
314
  overflow: hidden;
315
  text-overflow: ellipsis;
316
  white-space: nowrap;
317
}
318
 
319
#content #navigation a:hover
320
{
321
  background-color: #f0f0f0;
322
}
323
 
324
#content #navigation .current a
325
{
326
  background-color: #e0e0e0;
327
  font-weight: bold;
328
}
