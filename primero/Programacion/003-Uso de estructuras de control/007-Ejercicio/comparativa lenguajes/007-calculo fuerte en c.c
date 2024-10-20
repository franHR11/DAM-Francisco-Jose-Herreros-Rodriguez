#include <stdio.h>
#include <time.h>

int main() {
    // Start timing
    clock_t inicio = clock();

    // Print start time in seconds
    printf("Inicio: %f\n", (double)inicio / CLOCKS_PER_SEC);

    // Number of iterations and initial value
    long long int iteraciones = 1000000000;
    double numero = 1.00000000065;

    // Loop performing the multiplication
    for (long long int i = 0; i < iteraciones; i++) {
        numero *= 1.000000045;
    }

    // End timing
    clock_t final = clock();

    // Print end time in seconds
    printf("Final: %f\n", (double)final / CLOCKS_PER_SEC);

    // Print time taken
    printf("Tiempo transcurrido: %f segundos\n", (double)(final - inicio) / CLOCKS_PER_SEC);

    return 0;
}