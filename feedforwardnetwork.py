import tensorflow as tf
import numpy as np
import sys

tf.enable_eager_execution()


def activation(x):
    return tf.div(tf.constant(1.0), tf.add(tf.constant(1.0), tf.exp(tf.negative(x))))



class FeedForwardNetwork:

    def __init__(self, x):
        self.input = x
        self.weights1 = tf.constant([0.2, -0.1, 0.8, -0.5, 0.3, 0.7], shape=[3, 2])
        self.weights2 = tf.constant([0.7, 0.6, 0.9, -0.7], shape=[2, 2])
        self.weights3 = tf.constant([1.7, -2.7], shape=[2, 1])


    def feedforward(self):
        self.layer1 = activation(tf.matmul(self.input, self.weights1))
        self.layer2 = activation(tf.matmul(self.layer1, self.weights2))
        self.output = activation(tf.matmul(self.layer2, self.weights3))



x = tf.constant([1.0, -1.0, 0.5], shape=[1, 3])
ffn = FeedForwardNetwork(x)
ffn.feedforward()
tf.print(ffn.output, output_stream=sys.stdout)
