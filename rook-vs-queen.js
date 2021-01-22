// -----------------------------------------------------------------------------
// [BONUS] Rook vs Queen (Do this last)
// -----------------------------------------------------------------------------
// Welcome to Rook vs Queen! 

// Before you lies a chessboard whose dimensions are N by N where N > 1. 
// Randomly distributed on this chessboard are one rook, one queen, and any 
// number of pawns. Each turn, the player must move the rook with the goal of 
// capturing the queen. Rooks can move any number of cells horizontally or 
// vertically at a time but capturing a pawn is forbidden - you must move around
// the pawns. Every board configuration guarantees there is a valid path between 
// the rook and queen. The pawns and single Queen do not move between turns.

// Given the starting position of the rook, the position of the queen, and the 
// positions of the pawns, determine the smallest amount of moves required in 
// order to capture the queen.

// For example, the following is one possible board layout where R represents 
// the starting position of the rook, * represents the position of a pawn, and 
// Q represents the position of the queen:

// /-------------------\
// | - | 0 | 1 | 2 | 3 |
// |---+---+---+---+---|
// | A | R | * |   |   |
// |---+---+---+---+---|
// | B |   | * |   |   |
// |---+---+---+---+---|
// | C |   |   |   |   |
// |---+---+---+---+---|
// | D |   | * | Q |   |
// \-------------------/

// In this case, the shortest amount of moves required in order to capture the 
// queen would be 3: A0 to C0, C0 to C2, and C2 to D2.