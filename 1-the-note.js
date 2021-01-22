// -----------------------------------------------------------------------------
// 1. The Note 
// -----------------------------------------------------------------------------
// You need to create a note for someone using only letters cut out from a 
// magazine article.

// You are given:
// - a string that represents the text of a magazine article
// - a string that represents the message you need to write

// Write a function that will return true if it is possible to construct a given
// message from the article text.

// Note: messages use English uppercase and lowercase letters only.
// There will be no numbers or punctuation.

// Sample Usage:

// > // the following would return true since "a dance" can be constructed from the letters in "have a nice day"
// > canCreateNote("Have a nice day", "a dance")     // true

// > // the following would return false since the letter "d" only appears once in the source message
// > canCreateNote("Have a nice day", "dicey advice") // false

function canCreateNote(magazineArticleText, messageToWrite) {
    // split string into an array of chars
    magazineArticleText = magazineArticleText.split('')
    messageToWrite = messageToWrite.split('')

    let possibleToMakeString = true

    // loop through output to check if letter is in input
    for (let i = 0; i < messageToWrite.length; i++) {
        // get index of letter from messageToWrite in magazineArticleText
        let letterIndex = magazineArticleText.indexOf(messageToWrite[i])

        if (letterIndex !== -1) {
            // set value to null so letter can't be used again
            magazineArticleText[letterIndex] = null
        } else {
            possibleToMakeString = false
            break
        }    
    }

    return possibleToMakeString
}

console.log(canCreateNote("Have a nice day", "a dance"))
console.log(canCreateNote("Have a nice day", "dicey advice"))