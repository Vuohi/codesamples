package pong.ai;

import pong.Maila;
import pong.Pallo;
import pong.Pong;
import pong.Suunta;

//This is a program that plays a classic game Pong.
//The balls movement is predicted by it's location and direction and the padle is moved to the predicted location.

public class MunPongAly implements PongAi {

    @Override
    public Suunta annaSuunta(Maila oma, Maila vastustajan, Pallo pallo) {

        if (pallo.getTranslateY() + pallo.getLiike().getY() * Math.abs(oma.getTranslateX() - pallo.getTranslateX()) < 0 && oma.getTranslateY() <= 0) {
            return Suunta.PAIKALLAAN;
        } else if (pallo.getTranslateY() + pallo.getLiike().getY() * Math.abs(oma.getTranslateX() - pallo.getTranslateX()) > 300 && oma.getTranslateY() + Pong.MAILAN_KORKEUS >= 480) {
            return Suunta.PAIKALLAAN;
        } else if (oma.getTranslateY() + Pong.MAILAN_KORKEUS / 2 > pallo.getTranslateY() + pallo.getLiike().getY() * Math.abs(oma.getTranslateX() - pallo.getTranslateX())) {
            return Suunta.YLOS;
        } else {
            return Suunta.ALAS;
        }

    }

    @Override
    public String nimi() {
        return "MunPongAly!";
    }

}
