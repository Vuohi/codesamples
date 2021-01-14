/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sudokusolver;

/**
 *
 * @author katri
 */
public class Lauta {
    
    private int [][] numerot;
    
    public Lauta(String alkutila) {
        numerot = new int[9][9];
        for (int i = 0; i < 9; i++) {
            for (int j = 0; j < 9; j++) {
                numerot[j][i] = Character.getNumericValue(alkutila.charAt((i*9)+j));
            }
        }
    }
    
    public void setArvo(int x, int y, int arvo) {
        numerot[y][x] = arvo;
    }
    
    public int getArvo(int x, int y) {
        return numerot[y][x];
    }
    
    public void print() {
        for (int i = 0; i < 9; i++) {           
            for (int j = 0; j < 9; j++) {
                System.out.print("[" + numerot[j][i] + "]");
            }
            System.out.print("\n");
        }
    }
}
