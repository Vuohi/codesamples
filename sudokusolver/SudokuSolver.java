/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sudokusolver;

import java.util.HashSet;
import java.util.Scanner;

/**
 *
 * @author katri
 */
public class SudokuSolver {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        Scanner lukija  = new Scanner(System.in);
        System.out.println("Syötä sudoku merkkijonona (81 merkkiä). Käytä 0 merkkaamaan tyhjää kohtaa.");
        String alkutila = lukija.nextLine();
        
        Lauta lauta = new Lauta(alkutila);
        System.out.println("Syötit sudokun: ");
        lauta.print();
        
        System.out.println("Ratkaisen...");
        
        HashSet<Integer> tiedetyt = new HashSet<>();
        
        boolean sisaltaaNollan = true;
               
        while (sisaltaaNollan) {
            sisaltaaNollan = false;
            for (int i = 0; i < 9; i++) {
                for (int j = 0; j < 9; j++) {
                    if (lauta.getArvo(i, j) == 0) {
                        
                        for (int k = 0; k < 9; k++) {
                            if (lauta.getArvo(k, j) != 0) {
                                tiedetyt.add(lauta.getArvo(k, j));
                            }
                            if (lauta.getArvo(i, k) != 0) {
                                tiedetyt.add(lauta.getArvo(i, k));
                            }
                        }
                        int alataulukonX = (j/3)*3;
                        int alataulukonY = (i/3)*3;
                        for (int k = alataulukonY; k < alataulukonY + 3; k++) {
                            for (int m = alataulukonX; m < alataulukonX + 3; m++) {
                                if (lauta.getArvo(k, m) != 0) {
                                    tiedetyt.add(lauta.getArvo(k, m));
                                }
                            }
                        } 
                       
                        if (tiedetyt.size() == 8) {
                            
                            for (int k = 1; k <= 9; k++) {
                                if (!tiedetyt.contains(k)) {
                                    System.out.println("Muutetaan taulukkoa...");
                                    lauta.setArvo(i, j, k);
                                    
                                }
                            }
                        } else {
                            sisaltaaNollan = true;
                        }
                    }
                    tiedetyt.clear();
                }
            }                           
            System.out.println("Tämän hetken tilanne: ");
            lauta.print();            
        }
    }   
}
