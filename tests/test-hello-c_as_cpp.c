/*
 * This should give COMPILER-ERROR on the default problem 'hello'.
 * We don't accept .c as C++ filename extension, even though the code
 * is valid C++ too.
 *
 * @EXPECTED_RESULTS@: COMPILER-ERROR
 */

#include <stdio.h>

int main(int argc, char **argv)
{
	int i;
	char hello[20] = "Hello world!";
	printf("%s\n",hello);
	return 0;
}