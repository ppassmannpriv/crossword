#Crosswords

1. Define grid with longest word from list as min col/row
2. Get word with maxlength = col/row size or smaller / longest word in wordlist
3. place longest word on 1,1
4. search words with common characters
5. place word in non-conflicting place on board in junction with first word (first letter)
6. if no word can be found place next longest word in wordlist on n,n and reverse pattern

- should no words be left, the crossword is built
- this can take many loops to see if a good crossword can be built, that fits the grid and not do a staircase pattern
