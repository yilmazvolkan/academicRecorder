# Academic Recorder


# Introduction


In this project, I implement UI that shows the academic sota results in computer science. In the system, I have authors, papers and topics. Each paper consists of multiple authors and topics. Furthermore, I have a sota result for each
topic. It states the best result among the paper with respect to this particular topic. I implemented this project on PHP and the most important part is creating and designing the database. In order to accomplish this task, I need to create complex tables and connections among them.


# Requirements

* Only admins shall be able to add/update/delete papers, authors and topics.
* Users shall be able to separately view all authors, papers and topics in the system.
* Users shall be able to view all papers of an author.
* Users shall be able to view SOTA result by topic and which paper this SOTA was achieved.
* Users shall be able to view papers on a specific topic.
* Users shall be able to rank all authors by the number of SOTA results they have.
* Users shall be able to search a keyword and view the papers that contain this keyword in their title or abstract.


# Implementation


According to given task requirements list, I need to create 3 types of records:
* Authors:
   * It has a unique ID to specify which author are we dealing, creating, changing or
deleting.
   * Each author has unique name and surname combination. Meaning there is no
such a record with both names and surnames are in the system with the same
combination. However, we can always use name or surname for other authors
separately.
   * To create an author record, you should specify name and surname in admin
page.
* Topics:
   * It has a unique ID to specify which topic are we dealing, creating, changing or
deleting.
   * Each topic has unique name and sota result combination. Meaning there is no
such a record with both names and sota results are in the system with the same
combination. However, we can always use name or sota results for other topics
separately.
   * To create a topic record, you should only give name for that. Sota result is
calculated when we add this topic to a paper.
* Papers:
   * It has a unique ID to specify which paper are we dealing, creating, changing or
deleting.
   * Each topic has unique title. We cannot add more papers with the same title.
Furthermore, each paper has also a result and abstraction information. Also,
each paper has at least 1 topic and 1 author among the topics and authors. If
there is no such records in the system, UI simply asks to create one.
   * To create a paper record, you should give result, name, abstract and determine
the author and paper beforehand.


# ER Diagram

<p align="center">
<a href = "https://github.com/yilmazvolkan/academicRecorder"><img 
<img src="https://github.com/yilmazvolkan/academicRecorder/blob/master/er-diagram.png" width="700" height="320"></a>
</p>
